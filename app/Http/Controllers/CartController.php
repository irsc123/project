<?php

namespace App\Http\Controllers;

use App\Models\CartItem;
use App\Models\Order;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class CartController extends Controller
{
    // عرض سلة المستخدم الحالي
    public function index()
    {
        $userId = Auth::id(); // id المستخدم المسجّل

        $items = CartItem::with('product')
            ->where('user_id', $userId)
            ->get();

        // نحسب الإجمالي
        $total = $items->sum(function ($item) {
            $price = $item->product->discount_price ?? $item->product->price;
            return $price * $item->quantity;
        });

        return view('cart.index', compact('items', 'total'));
    }

    // إضافة منتج للسلة
    public function add(Request $request)
    {
        $request->validate([
            'product_id' => 'required|exists:products,id',
            'quantity'   => 'required|integer|min:1',
        ]);

        $userId  = Auth::id();
        $product = Product::findOrFail($request->product_id);

        // لو المنتج موجود في السلة، نزيد الكمية بدل ما نكرره
        CartItem::updateOrCreate(
            [
                'user_id'    => $userId,
                'product_id' => $product->id,
            ],
            [
                'quantity' => \DB::raw('quantity + ' . (int)$request->quantity),
            ]
        );

        return redirect()->route('cart.index')->with('success', 'تم إضافة المنتج إلى السلة ✅');
    }

    // حذف عنصر من السلة
    public function remove($id)
    {
        $userId = Auth::id();

        $item = CartItem::where('user_id', $userId)->where('id', $id)->firstOrFail();
        $item->delete();

        return redirect()->route('cart.index')->with('success', 'تم حذف المنتج من السلة ✅');
    }
}
