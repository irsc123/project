<?php

namespace App\Http\Controllers;

use App\Models\CartItem;
use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class CheckoutController extends Controller
{
    /**
     * صفحة إتمام الطلب.
     */
    public function index()
    {
        $userId = Auth::id();

        $items = CartItem::with('product')
            ->where('user_id', $userId)
            ->get();

        if ($items->isEmpty()) {
            return redirect()->route('cart.index')->with('error', 'سلتك فارغة، لا يمكنك إتمام الطلب.');
        }

        $total = $items->sum(function ($item) {
            $price = $item->product->discount_price ?? $item->product->price;
            return $price * $item->quantity;
        });

        return view('checkout.index', compact('items', 'total'));
    }

    /**
     * إنشاء الطلب من السلة وحفظه في جداول orders و order_items.
     */
    public function store(Request $request)
    {
        $request->validate([
            'shipping_address' => 'required|string|max:500',
            'payment_method'   => 'required|in:cash,transfer,card',
            'phone'            => 'nullable|string|max:30',
            'notes'            => 'nullable|string|max:500',
        ]);

        $userId = Auth::id();

        $cartItems = CartItem::with('product')
            ->where('user_id', $userId)
            ->get();

        if ($cartItems->isEmpty()) {
            return redirect()->route('cart.index')->with('error', 'سلتك فارغة، لا يمكنك إتمام الطلب.');
        }

        // حساب الإجمالي
        $total = $cartItems->sum(function ($item) {
            $price = $item->product->discount_price ?? $item->product->price;
            return $price * $item->quantity;
        });

        DB::beginTransaction();

        try {
            $shippingAddress = $request->shipping_address;
            if ($request->filled('phone')) {
                $shippingAddress .= ' | جوال: ' . $request->phone;
            }
            if ($request->filled('notes')) {
                $shippingAddress .= ' | ملاحظات: ' . $request->notes;
            }

            // إنشاء الطلب
            $order = Order::create([
                'user_id'          => $userId,
                'total_amount'     => $total,
                'status'           => 'pending',
                'shipping_address' => $shippingAddress,
                'payment_method'   => $request->payment_method,
            ]);

            // نقل عناصر السلة إلى order_items
            foreach ($cartItems as $cartItem) {
                $product = $cartItem->product;
                $unitPrice = $product->discount_price ?? $product->price;
                $quantity = $cartItem->quantity;
                $totalPrice = $unitPrice * $quantity;

                OrderItem::create([
                    'order_id'    => $order->id,
                    'product_id'  => $product->id,
                    'quantity'    => $quantity,
                    'unit_price'   => $unitPrice,
                    'total_price'  => $totalPrice,
                ]);

                // تقليل المخزون إن وُجد
                if (isset($product->in_stock) && $product->in_stock >= $quantity) {
                    $product->decrement('in_stock', $quantity);
                }
            }

            // تفريغ السلة بعد إتمام الطلب
            CartItem::where('user_id', $userId)->delete();

            DB::commit();

            return redirect()->route('checkout.success', $order->id)->with('success', 'تم إنشاء طلبك بنجاح!');
        } catch (\Throwable $e) {
            DB::rollBack();
            return redirect()->route('cart.index')->with('error', 'حدث خطأ أثناء إتمام الطلب، حاول مرة أخرى.');
        }
    }

    /**
     * صفحة نجاح الطلب.
     */
    public function success(Order $order)
    {
        // تأكد أن الطلب يخص المستخدم الحالي
        if ($order->user_id !== Auth::id()) {
            abort(403);
        }

        $order->load('items.product');

        return view('checkout.success', compact('order'));
    }
}
