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

    // Xoá dấu câu & từ không cần thiết
    $clean = preg_replace('/[^\p{L}\p{N}\s]/u', '', $msg);
    $clean = preg_replace('/\b(tư vấn|cho|về|sản phẩm|giày|xin|hãy|đi|nhé|ạ|nha|cần|mua|muốn)\b/u', '', $clean);
    $clean = trim($clean);

    Log::info('Tin nhắn gốc: ' . $msg);
    Log::info('Tin nhắn đã làm sạch: ' . $clean);

    // --- Gợi ý theo giá ---
    if (preg_match('/(?:từ\s*)?(\d+)\s*(tr|triệu|k|nghìn)?\s*(?:đến|tới|-)\s*(\d+)\s*(tr|triệu|k|nghìn)?/iu', $clean, $m)) {
        $unit1 = in_array($m[2] ?? '', ['tr', 'triệu']) ? 1_000_000 : 1_000;
        $unit2 = in_array($m[4] ?? '', ['tr', 'triệu']) ? 1_000_000 : 1_000;
        return $this->suggestProducts($m[1] * $unit1, $m[3] * $unit2);
    }

    if (preg_match('/(dưới|khoảng|tầm|trong)\s*(\d+)\s*(tr|triệu|k|nghìn)?/iu', $clean, $m)) {
        $unit = in_array($m[3] ?? '', ['tr', 'triệu']) ? 1_000_000 : 1_000;
        return $this->suggestProducts(0, $m[2] * $unit);
    }

    if (preg_match('/(trên|từ)\s*(\d+)\s*(tr|triệu|k|nghìn)?/iu', $clean, $m)) {
        $unit = in_array($m[3] ?? '', ['tr', 'triệu']) ? 1_000_000 : 1_000;
        return $this->suggestProducts($m[2] * $unit, null);
    }

    if (preg_match('/(\d+)\s*(tr|triệu|k|nghìn)/iu', $clean, $m)) {
        $unit = in_array($m[2], ['tr', 'triệu']) ? 1_000_000 : 1_000;
        return $this->suggestProducts(0, $m[1] * $unit);
    }

    // --- Câu hỏi liên quan đến giá ---
    if (preg_match('/(giá|bao nhiêu|chi phí|tiền|giá cả|bao lăm|giá ntn|giá ra sao)/iu', $clean)) {
        return 'Bạn muốn tìm sản phẩm tầm giá bao nhiêu nè? 💸 Ví dụ: <br>• "dưới 3 triệu"<br>• "từ 2 đến 5 triệu"<br>• "500k"<br>Mình sẽ gợi ý liền nha! 😘';
    }
    // --- Nhận dạng chiều cao & cân nặng để tư vấn size ---

    // --- Tư vấn size giày theo chiều dài bàn chân ---
if (preg_match('/(dài chân|bàn chân|chiều dài)\s*(\d{2}(?:\.\d+)?)\s*cm?/iu', $clean, $m)) {
    $footLength = (float) $m[2];
    return $this->suggestShoeSize($footLength);
}


    // --- FAQs dễ thương ---
    $faq = [
        'ship|giao hàng|vận chuyển' => 'Dạ có ạ, shop giao hàng toàn quốc 🚚 Đặt hôm nay là sớm mai gửi luôn nha!',
        'bảo hành|warranty' => 'Sản phẩm được bảo hành 12 tháng chính hãng nha bạn yêu 🛡️',
        'cod|thanh toán' => 'Có COD luôn bạn nhé! Nhận hàng kiểm tra rồi thanh toán ạ 💵',
        'bao lâu|mất bao lâu|thời gian' => 'Thời gian giao hàng chỉ từ 1 - 3 ngày tuỳ khu vực nè ⏳',
        'cửa hàng|địa chỉ|shop' => 'Hiện shop đang bán online để tiết kiệm chi phí cho bạn đó 🛍️ Nhưng chất lượng thì vẫn xịn xò nha!',
        'chính hãng|fake|thật' => 'Tất cả đều chính hãng 100%, có tem mác, bảo hành đàng hoàng luôn 💯',
        'màu|color' => 'Sản phẩm nhiều màu đẹp lắm luôn 🥰 Bạn xem chi tiết tại trang sản phẩm nha!',
        'size|kích thước|sz' => 'Bảng size có sẵn trên trang sản phẩm rồi đó ạ, nếu không chắc mình hỗ trợ chọn size luôn 😉',
        'hỗ trợ|help|giúp' => 'Bạn cần gì cứ nói nhen! Mình sẵn sàng tư vấn từ A đến Z cho bạn luôn 🤝',
    ];

    foreach ($faq as $keyword => $reply) {
        if (preg_match("/($keyword)/iu", $clean)) return $reply;
    }

    // --- Chào hỏi ---
    if (preg_match('/(xin chào|chào|hello|hi|hey|lô)/iu', $clean)) {
        return 'Chào bạn 🥰 Mình là Trợ lý của shop! Bạn đang cần hỗ trợ về vấn đề gì ạ ?';
    }

    // --- Mặc định ---
  return 'Hi bạn 👋 Rất vui được hỗ trợ bạn! Bạn cần tư vấn về mẫu giày, giá hay size không ạ?';

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
$url = route('home.products');

$html .= <<<HTML
    <div style="margin-top:12px;">
        <a href="{$url}" target="_blank">
            <button style="padding:6px 12px; background:#10b981; color:white; border:none; border-radius:6px;">
                Xem thêm sản phẩm
            </button>
        </a>
    </div>
HTML;




    return $html;
}
private function suggestShoeSize($footLength)
{
    $sizeChart = [
        22.7 => 36,
        23.3 => 37,
        24.0 => 38,
        24.7 => 39,
        25.3 => 40,
        26.0 => 41,
        26.7 => 42,
        27.3 => 43,
        28.0 => 44,
        28.7 => 45,
        29.3 => 46,
    ];

    // Nếu chiều dài quá nhỏ hoặc không hợp lệ
    if ($footLength < 20 || $footLength > 30) {
        return "Chiều dài bàn chân <b>{$footLength}cm</b> hiện ngoài khoảng size tiêu chuẩn bên mình (36 - 46 EU) 😢.<br> Bạn vui lòng kiểm tra lại hoặc để mình hỗ trợ thêm cho chính xác nha!";
    }

    $recommendedSize = null;

    // Tìm size gần nhất
    foreach ($sizeChart as $length => $size) {
        if ($footLength <= $length) {
            $recommendedSize = $size;
            break;
        }
    }

    if ($recommendedSize) {
        return "Với chiều dài bàn chân khoảng <b>{$footLength}cm</b>, bạn nên chọn size giày <b style='color:#10b981;'>EU {$recommendedSize}</b> nha! 👟<br>Nếu cần tư vấn thêm về form giày (rộng/chật), bạn cứ nhắn mình hỗ trợ liền luôn! 😊";
    }

    return "Rất tiếc, hiện tại bên mình chưa có size phù hợp với chiều dài chân <b>{$footLength}cm</b>. Bạn có thể kiểm tra lại giúp mình hoặc chat để được tư vấn kỹ hơn nhé!";
}



}
