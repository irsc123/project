<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    // عرض نموذج إضافة المنتج
    public function create()
    {
        $categories = Category::all();
        return view('products.create', compact('categories'));
    }

  public function store(Request $request)
{
    $request->validate([
        'category_id'    => 'required|exists:categories,id',
        'name'           => 'required|string|max:255',
        'description'    => 'nullable|string',
        'price'          => 'required|numeric',
        'discount_price' => 'nullable|numeric',
        'in_stock'       => 'required|integer|min:0',
        'image'          => 'required|image|mimes:jpg,jpeg,png,webp|max:4096',
    ]);

    // 🔥 تحويل الصورة إلى Base64 وتخزينها في قاعدة البيانات
    $imageContent = null;

    if ($request->hasFile('image')) {
        $file      = $request->file('image');
        $mime      = $file->getClientMimeType();                   // نوع الصورة مثل image/jpeg
        $data      = base64_encode(file_get_contents($file));      // مجرد Base64
        $imageContent = "data:$mime;base64,$data";                 // دمج النوع مع base64
    }

    // 🔥 حفظ المنتج في قاعدة البيانات
    Product::create([
        'category_id'    => $request->category_id,
        'name'           => $request->name,
        'description'    => $request->description,
        'price'          => $request->price,
        'discount_price' => $request->discount_price,
        'in_stock'       => $request->in_stock,
        'image'          => $imageContent,
        'is_best_seller' => $request->has('is_best_seller') ? 1 : 0,
        'is_active'      => 1,
    ]);

    // 🔥 رجوع للصفحة مع رسالة نجاح
    return redirect()->back()->with('success', 'تم إضافة المنتج بنجاح وحفظه في قاعدة البيانات 🎉');
}
public function editDiscount($id)
    {
        $product = Product::findOrFail($id);

        return view('products.discount', compact('product'));
    }

    // حفظ الخصم
    public function updateDiscount(Request $request, $id)
    {
        $product = Product::findOrFail($id);

        $request->validate([
            'discount_price' => 'nullable|numeric|min:0',
        ]);

        // تحقق بسيط: الخصم أقل من السعر
        if ($request->discount_price !== null && $request->discount_price >= $product->price) {
            return back()->withErrors([
                'discount_price' => 'سعر الخصم يجب أن يكون أقل من السعر الأساسي (' . $product->price . ').',
            ])->withInput();
        }

        $product->update([
            'discount_price' => $request->discount_price, // null = إلغاء الخصم
        ]);

        // 🔥 انتبه هنا: لا نستخدم route('products.discount.update') أبداً
        return redirect()
            ->route('products.index')
            ->with('success', 'تم تحديث خصم المنتج بنجاح ✅');
}



public function index()
    {
        $products = Product::with('category')->latest()->get();

        return view('products.index', compact('products'));
    }

    public function destroy($id)
    {
        $product = Product::findOrFail($id);

        // لو فيه cart_items أو order_items ومعرفين بـ cascadeOnDelete، تنحذف تلقائي
        $product->delete();

        return redirect()->route('products.index')->with('success', 'تم حذف المنتج بنجاح ✅');
    }

    public function show($id)
{
    $product = Product::with('category')->findOrFail($id);

    return view('products.show', compact('product'));
}
    public function edit($id)
{
    $product    = Product::findOrFail($id);
    $categories = Category::all();

    return view('products.edit', compact('product', 'categories'));
}

public function update(Request $request, $id)
{
    $product = Product::findOrFail($id);

    $request->validate([
        'category_id'    => 'required|exists:categories,id',
        'name'           => 'required|string|max:255',
        'description'    => 'nullable|string',
        'price'          => 'required|numeric',
        'discount_price' => 'nullable|numeric',
        'in_stock'       => 'required|integer|min:0',
        'image'          => 'nullable|image|mimes:jpg,jpeg,png,webp|max:4096',
        'is_best_seller' => 'nullable|boolean',
    ]);

    // نفس فكرة الإنشاء: نحدّث الصورة لو المستخدم رفع واحدة جديدة
    $imageContent = $product->image; // القيمة القديمة

    if ($request->hasFile('image')) {
        $file = $request->file('image');
        $mime = $file->getClientMimeType();
        $data = base64_encode(file_get_contents($file));
        $imageContent = "data:$mime;base64,$data";
    }

    $product->update([
        'category_id'    => $request->category_id,
        'name'           => $request->name,
        'description'    => $request->description,
        'price'          => $request->price,
        'discount_price' => $request->discount_price,
        'in_stock'       => $request->in_stock,
        'image'          => $imageContent,
        'is_best_seller' => $request->has('is_best_seller') ? 1 : 0,
        'is_active'      => 1,
    ]);

    return redirect()->route('products.index')->with('success', 'تم تحديث المنتج بنجاح ✅');
}

}
