<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index(Request $request)
    {
        // Lọc theo ngày cho toàn bộ truy vấn
        $from = $request->from_date;
        $to = $request->to_date;

        // Doanh thu theo tháng
        $revenueQuery = DB::table('orders')
            ->where('status', 'completed');

        if ($from)
            $revenueQuery->whereDate('created_at', '>=', $from);
        if ($to)
            $revenueQuery->whereDate('created_at', '<=', $to);

        $revenueData = $revenueQuery
            ->selectRaw("DATE_FORMAT(created_at, '%Y-%m') as month_year, SUM(total_amount) as revenue")
            ->groupBy('month_year')
            ->orderBy('month_year')
            ->get();

        $months = $revenueData->pluck('month_year')->toArray();
        $revenues = $revenueData->pluck('revenue')->toArray();

        // Trạng thái đơn hàng
        $orderStatusQuery = DB::table('orders');
        if ($from)
            $orderStatusQuery->whereDate('created_at', '>=', $from);
        if ($to)
            $orderStatusQuery->whereDate('created_at', '<=', $to);

        $orderStatusCounts = $orderStatusQuery
            ->select('status', DB::raw('COUNT(*) as count'))
            ->groupBy('status')
            ->pluck('count', 'status')->toArray();

        // Top sản phẩm
        $topProducts = DB::table('order_details')
            ->join('orders', 'orders.id', '=', 'order_details.order_id')
            ->where('orders.status', 'completed') // Chỉ tính đơn hàng hoàn thành
            ->when($from, fn($q) => $q->whereDate('orders.created_at', '>=', $from))
            ->when($to, fn($q) => $q->whereDate('orders.created_at', '<=', $to))
            ->select('order_details.product_name', DB::raw('SUM(order_details.quantity) as total'))
            ->groupBy('order_details.product_name')
            ->orderByDesc('total')
            ->limit(5)
            ->get();

        $topProductNames = $topProducts->pluck('product_name')->toArray();
        $topProductQuantities = $topProducts->pluck('total')->toArray();

        // Màu phổ biến
        $colorStats = DB::table('order_details')
            ->join('orders', 'orders.id', '=', 'order_details.order_id')
            ->when($from, fn($q) => $q->whereDate('orders.created_at', '>=', $from))
            ->when($to, fn($q) => $q->whereDate('orders.created_at', '<=', $to))
            ->select('order_details.color_name', DB::raw('SUM(order_details.quantity) as total'))
            ->groupBy('order_details.color_name')
            ->orderByDesc('total')
            ->get();

        $colors = $colorStats->pluck('color_name')->toArray();
        $colorQuantities = $colorStats->pluck('total')->toArray();

        // Tồn kho (không cần lọc ngày)
        $stockData = DB::table('product_variants')
            ->join('products', 'product_variants.product_id', '=', 'products.id')
            ->select('products.name as product_name', 'color_name', 'size', 'product_variants.quantity')
            ->orderByDesc('product_variants.quantity')
            ->limit(10)
            ->get();

        // Tỷ lệ đơn hàng
        $statusQuery = DB::table('orders');
        if ($from)
            $statusQuery->whereDate('created_at', '>=', $from);
        if ($to)
            $statusQuery->whereDate('created_at', '<=', $to);

        $totalOrders = $statusQuery->count();
        $percentStatus = [];

        if ($totalOrders > 0) {
            $statuses = ['completed', 'cancelled', 'returned'];
            foreach ($statuses as $status) {
                $count = (clone $statusQuery)->where('status', $status)->count();
                $percentStatus[$status] = round($count / $totalOrders * 100, 2);
            }
        }

        // Thống kê voucher
        $voucherStats = DB::table('vouchers')
            ->selectRaw('
                COUNT(*) as total_vouchers,
                SUM(CASE WHEN is_active = 1 THEN 1 ELSE 0 END) as active_vouchers,
                SUM(CASE WHEN is_active = 0 THEN 1 ELSE 0 END) as inactive_vouchers,
                SUM(quantity) as total_quantity,
                SUM(used_count) as total_used,
                SUM(CASE WHEN end_date < NOW() THEN 1 ELSE 0 END) as expired_vouchers
            ')
            ->first();

        // Top voucher được sử dụng nhiều nhất
        $topVouchers = DB::table('vouchers')
            ->select('code', 'discount_type', 'discount_value', 'used_count', 'quantity')
            ->where('used_count', '>', 0)
            ->orderByDesc('used_count')
            ->limit(5)
            ->get();

        return view('admin.index', compact(
            'months',
            'revenues',
            'orderStatusCounts',
            'topProductNames',
            'topProductQuantities',
            'colors',
            'colorQuantities',
            'stockData',
            'percentStatus',
            'voucherStats',
            'topVouchers',
            'from',
            'to'
        ));
    }
}