<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Product;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    /**
     * عرض كل الطلبات مع بيانات العميل وعدد المنتجات والكميات.
     */
    public function index(Request $request)
    {
        $orders = Order::with('user')
            ->withCount('items')
            ->withSum('items as items_quantity', 'quantity')
            ->when($request->filled('status'), function ($query) use ($request) {
                $query->where('status', $request->status);
            })
            ->latest()
            ->paginate(15)
            ->withQueryString();

        $stats = [
            'orders'  => Order::count(),
            'revenue' => Order::where('status', '!=', 'cancelled')->sum('total_amount'),
            'items'   => OrderItem::whereHas('order', function ($query) {
                $query->where('status', '!=', 'cancelled');
            })->sum('quantity'),
            'buyers'  => Order::distinct()->count('user_id'),
        ];

        return view('admin.orders.index', compact('orders', 'stats'));
    }

    /**
     * تفاصيل طلب واحد: العميل + كل المنتجات التي اشتراها.
     */
    public function show(Order $order)
    {
        $order->load(['user', 'items.product.category']);

        return view('admin.orders.show', compact('order'));
    }

    /**
     * تحديث حالة الطلب.
     */
    public function updateStatus(Request $request, Order $order)
    {
        $request->validate([
            'status' => 'required|in:pending,processing,shipped,completed,cancelled',
        ]);

        $order->update(['status' => $request->status]);

        return redirect()
            ->back()
            ->with('success', 'تم تحديث حالة الطلب إلى: ' . $order->status_label);
    }

    /**
     * تقرير من اشترى منتجاً معيناً وكم اشترى وتفاصيل كل عمليات الشراء.
     */
    public function productBuyers(Product $product)
    {
        $product->load('category');

        // كل عمليات شراء هذا المنتج (باستثناء الطلبات الملغية)
        $purchases = OrderItem::with(['order.user'])
            ->where('product_id', $product->id)
            ->whereHas('order', function ($query) {
                $query->where('status', '!=', 'cancelled');
            })
            ->get()
            ->sortByDesc(function ($item) {
                return $item->order->created_at;
            })
            ->values();

        // تجميع المشتريات حسب العميل
        $buyers = $purchases
            ->groupBy(function ($item) {
                return $item->order->user_id;
            })
            ->map(function ($items) {
                $first = $items->first();

                return [
                    'user'          => $first->order->user,
                    'quantity'      => $items->sum('quantity'),
                    'total'         => $items->sum('total_price'),
                    'orders_count'  => $items->pluck('order_id')->unique()->count(),
                    'last_purchase' => $items->max(function ($item) {
                        return $item->order->created_at;
                    }),
                    'items'         => $items,
                ];
            })
            ->sortByDesc('quantity')
            ->values();

        $summary = [
            'quantity' => $purchases->sum('quantity'),
            'revenue'  => $purchases->sum('total_price'),
            'buyers'   => $buyers->count(),
            'orders'   => $purchases->pluck('order_id')->unique()->count(),
        ];

        return view('admin.orders.product-buyers', compact('product', 'buyers', 'purchases', 'summary'));
    }
}
