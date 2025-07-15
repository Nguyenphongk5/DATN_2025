<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Message;
use App\Models\Product;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class ChatController extends Controller
{
    public function index(Request $request)
    {
        $userId = $request->input('user_id') ?? Auth::id();

        $messages = Message::where('user_id', $userId)
            ->orderBy('created_at', 'asc')
            ->get();

        return response()->json($messages);
    }

    public function store(Request $request)
    {
        $request->validate([
            'message'  => 'required|string',
            'user_id'  => 'required|exists:users,id',
            'is_admin' => 'required|boolean',
        ]);

        $message = Message::create([
            'user_id'  => $request->user_id,
            'message'  => $request->message,
            'is_admin' => $request->is_admin,
            'admin_id' => $request->is_admin ? Auth::id() : null,
        ]);

        if (!$request->is_admin) {
            $autoReply = $this->generateAutoReply($request->message);
            if ($autoReply) {
                Message::create([
                    'user_id'  => $request->user_id,
                    'message'  => $autoReply,
                    'is_admin' => true,
                    'admin_id' => null,
                ]);
            }
        }

        return response()->json(['message' => 'Message sent.'], 201);
    }

    public function generateAutoReply($msg)
    {
        $msg = mb_strtolower(trim($msg));

        // Làm sạch câu: xóa dấu câu + từ vô nghĩa
        $clean = preg_replace('/[^\p{L}\p{N}\s]/u', '', $msg); // bỏ dấu câu
        $clean = preg_replace('/\b(tư vấn|cho|về|sản phẩm|giày|xin|hãy|đi|nhé|ạ|nha|cần|mua|muốn)\b/u', '', $clean);
        $clean = trim($clean);

        Log::info('Tin nhắn gốc: ' . $msg);
        Log::info('Tin nhắn đã làm sạch: ' . $clean);

        // 1. Khoảng giá: từ X đến Y (hoặc: X đến Y)
        if (preg_match('/(?:từ\s*)?(\d+)\s*(tr|triệu|k|nghìn)?\s*(?:đến|tới|-)\s*(\d+)\s*(tr|triệu|k|nghìn)?/iu', $clean, $m)) {
            Log::info('Phân loại: khoảng giá từ - đến');
            $unit1 = in_array($m[2] ?? '', ['tr', 'triệu']) ? 1_000_000 : 1_000;
            $unit2 = in_array($m[4] ?? '', ['tr', 'triệu']) ? 1_000_000 : 1_000;
            return $this->suggestProducts($m[1] * $unit1, $m[3] * $unit2);
        }

        // 2. Dưới X
        if (preg_match('/(dưới|khoảng|tầm|trong)\s*(\d+)\s*(tr|triệu|k|nghìn)?/iu', $clean, $m)) {
            Log::info('Phân loại: dưới X');
            $unit = in_array($m[3] ?? '', ['tr', 'triệu']) ? 1_000_000 : 1_000;
            return $this->suggestProducts(0, $m[2] * $unit);
        }

        // 3. Trên hoặc từ X
        if (preg_match('/(trên|từ)\s*(\d+)\s*(tr|triệu|k|nghìn)?/iu', $clean, $m)) {
            Log::info('Phân loại: trên hoặc từ X');
            $unit = in_array($m[3] ?? '', ['tr', 'triệu']) ? 1_000_000 : 1_000;
            return $this->suggestProducts($m[2] * $unit, null);
        }

        // 4. Chỉ số và đơn vị: 500k, 3tr
        if (preg_match('/(\d+)\s*(tr|triệu|k|nghìn)/iu', $clean, $m)) {
            Log::info('Phân loại: đơn giá đơn lẻ');
            $unit = in_array($m[2], ['tr', 'triệu']) ? 1_000_000 : 1_000;
            return $this->suggestProducts(0, $m[1] * $unit);
        }

        // 5. Câu hỏi liên quan đến giá
        if (preg_match('/(giá|bao nhiêu|chi phí|tiền|giá cả|bao lăm|giá ntn|giá ra sao)/iu', $clean)) {
            return 'Bạn muốn tìm sản phẩm khoảng bao nhiêu tiền ạ? Ví dụ: "dưới 5 triệu", "từ 2 đến 4 triệu", "500k"...';
        }

        // 6. FAQs
        $faq = [
            'ship|giao hàng|vận chuyển' => 'Dạ có ạ, shop hỗ trợ giao hàng toàn quốc.',
            'bảo hành|warranty' => 'Sản phẩm được bảo hành 12 tháng bạn nhé.',
            'cod|thanh toán' => 'Dạ có hỗ trợ COD (kiểm tra hàng trước khi thanh toán).',
            'bao lâu|mất bao lâu|thời gian' => 'Thời gian giao hàng từ 1 - 3 ngày tuỳ khu vực.',
            'cửa hàng|địa chỉ|shop' => 'Shop hiện bán online, chưa có cửa hàng trực tiếp.',
            'chính hãng|fake|thật' => 'Dạ sản phẩm đều chính hãng 100%, đầy đủ tem mác.',
            'màu|color' => 'Sản phẩm có nhiều màu sắc, bạn có thể xem chi tiết trên trang sản phẩm.',
            'size|kích thước|sz' => 'Bạn có thể xem bảng size chi tiết trên trang sản phẩm nhé.',
            'hỗ trợ|help|giúp' => 'Mình có thể hỗ trợ bạn tìm sản phẩm theo giá hoặc tư vấn phù hợp nè.',
        ];

        foreach ($faq as $k => $v) {
            if (preg_match("/($k)/iu", $clean)) return $v;
        }

        // 7. Chào hỏi
        if (preg_match('/(xin chào|chào|hello|hi|hey|lô)/iu', $clean)) {
            return 'Chào bạn! Mình có thể hỗ trợ bạn tìm sản phẩm theo giá. Ví dụ: "dưới 3 triệu", "từ 2 đến 5 triệu"... 😊';
        }

        // 8. Mặc định
        return 'Cảm ơn bạn đã nhắn tin! Bạn có thể nhập như:<br>• "dưới 3 triệu"<br>• "từ 2 đến 5 triệu"<br>• "500k"<br> để mình gợi ý sản phẩm phù hợp.';
    }

    private function suggestProducts($min = 0, $max = null)
{
    $query = Product::query();

    $query->where(function ($q) use ($min, $max) {
        $q->whereRaw('COALESCE(price_sale, price) >= ?', [$min]);
        if (!is_null($max)) {
            $q->whereRaw('COALESCE(price_sale, price) <= ?', [$max]);
        }
    });

    $products = $query->limit(3)->get();

    if ($products->isEmpty()) {
        return 'Hiện tại không có sản phẩm nào trong tầm giá bạn yêu cầu.';
    }

    $html = "<div><b>Dưới đây là một số sản phẩm phù hợp:</b></div>";

    foreach ($products as $p) {
        // Sửa đường dẫn ảnh đúng chuẩn Laravel storage
        $imgPath = $p->img_thumb ? asset('storage/' . $p->img_thumb) : 'https://via.placeholder.com/60';
        $link = route('product.show', $p->id);
        $priceDisplay = $p->price_sale ?: $p->price;
        $price = number_format($priceDisplay) . 'đ';

        $html .= <<<HTML
            <div style="display:flex; gap:8px; margin-top:10px;">
                <img src="{$imgPath}" width="60" height="60" style="border-radius:8px;">
                <div>
                    <a href="{$link}" target="_blank" style="font-weight:bold; color:#4f46e5;">{$p->name}</a><br>
                    <span style="color:gray;">Giá: <b style="color:#e11d48;">{$price}</b></span>
                </div>
            </div>
        HTML;
    }

    $html .= <<<HTML
        <div style="margin-top:12px;">
            <button onclick="sendQuickReply('Tư vấn theo nhu cầu')" style="padding:6px 12px; background:#4f46e5; color:white; border:none; border-radius:6px; margin-right:8px;">Tư vấn theo nhu cầu</button>
            <button onclick="sendQuickReply('Xem thêm sản phẩm')" style="padding:6px 12px; background:#e5e7eb; color:black; border:none; border-radius:6px;">Xem thêm</button>
        </div>
    HTML;

    return $html;
}

}
