<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    // عرض نموذج إضافة قسم جديد
    public function create()
    {
        return view('categories.create');
    }

    // حفظ القسم
    public function store(Request $request)
    {
        $request->validate([
            'name'        => 'required|string|max:255',
            'description' => 'nullable|string',
        ]);

        Category::create([
            'name'        => $request->name,
            'description' => $request->description,
        ]);

        return redirect()->back()->with('success', 'تم إضافة القسم بنجاح ✅');
    }

    // ✅ عرض كل الأقسام
    public function index()
    {
        $categories = Category::withCount('products')->get();

        return view('categories.index', compact('categories'));
    }

    // ✅ حذف قسم
    public function destroy($id)
    {
        $category = Category::findOrFail($id);

        // لو عندك foreign key بـ cascadeOnDelete، المنتجات راح تنحذف معه تلقائياً
        $category->delete();

        return redirect()->route('categories.index')->with('success', 'تم حذف القسم بنجاح ✅');
}

public function show($id)
{
    $category = Category::with('products')->findOrFail($id);

    return view('categories.show', compact('category'));
}
public function edit($id)
{
    $category = Category::findOrFail($id);

    return view('categories.edit', compact('category'));
}

public function update(Request $request, $id)
{
    $request->validate([
        'name'        => 'required|string|max:255',
        'description' => 'nullable|string',
    ]);

    $category = Category::findOrFail($id);

    $category->update([
        'name'        => $request->name,
        'description' => $request->description,
    ]);

    return redirect()->route('categories.index')->with('success', 'تم تحديث القسم بنجاح ✅');
}
}
