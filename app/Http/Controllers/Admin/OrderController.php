<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    //
    public function index()
    {
        $orders = Order::with(['user', 'course'])
            ->latest()
            ->paginate(10);

        $revenue = Order::selectRaw("strftime('%m', approved_at) as month, SUM(price) as total")
            ->where('status', 'paid')
            ->whereNotNull('approved_at')
            ->groupByRaw("strftime('%m', approved_at)")
            ->pluck('total', 'month');

        $chartData = [];

        for ($i = 1; $i <= 12; $i++) {
            $month = str_pad($i, 2, '0', STR_PAD_LEFT);
            $chartData[$i] = $revenue[$month] ?? 0;
        }

        return view('admin.orders.index', [
            'orders' => $orders,
            'chartData' => array_values($chartData)
        ]);
    }
    public function approve(Order $order)
{
    // Nếu đã duyệt rồi
    if ($order->status === 'paid') {
        return back()->with('info', 'Đơn hàng này đã được duyệt trước đó.');
    }

    $order->update([
        'status' => 'paid',
        'approved_at' => now()
    ]);

    return back()->with('success', 'Đã duyệt đơn hàng thành công.');
}
}
