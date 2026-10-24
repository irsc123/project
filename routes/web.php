<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CartController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/



Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';

// الصفحة الرئيسية
// ==========================
Route::get('/', [HomeController::class, 'index'])->name('home');


// الأقسام (المستخدم + الأدمن)
// ==========================

// صفحة قسم واحد (للمستخدم)
Route::get('/categories/{id}', [CategoryController::class, 'show'])
    ->name('categories.show');



// المنتجات (المستخدم + الأدمن)
// ==========================

// صفحة منتج واحد
Route::get('/products/{id}', [ProductController::class, 'show'])
    ->name('products.show');



// السلة Cart (المستخدم)
// ==========================

Route::middleware(['auth'])->group(function () {

    // صفحة السلة
    Route::get('/cart', [CartController::class, 'index'])->name('cart.index');

    // إضافة للسلة
    Route::post('/cart/add', [CartController::class, 'add'])->name('cart.add');

    // حذف عنصر من السلة
    Route::delete('/cart/{id}', [CartController::class, 'remove'])->name('cart.remove');
});





Route::middleware(['auth'])->group(function () {

    // ====== إدارة الأقسام ======
    Route::get('/admin/categories', [CategoryController::class, 'index'])
        ->name('categories.index')->middleware(['auth', 'admin']);

    Route::get('/admin/categories/create', [CategoryController::class, 'create'])
        ->name('categories.create')->middleware(['auth', 'admin']);

    Route::post('/admin/categories', [CategoryController::class, 'store'])
        ->name('categories.store')->middleware(['auth', 'admin']);

    Route::delete('/admin/categories/{id}', [CategoryController::class, 'destroy'])
        ->name('categories.destroy')->middleware(['auth', 'admin']);

    Route::get('/admin/categories/{id}/edit', [CategoryController::class, 'edit'])
    ->name('categories.edit')->middleware(['auth', 'admin']);

    Route::put('/admin/categories/{id}', [CategoryController::class, 'update'])
    ->name('categories.update')->middleware(['auth', 'admin']);


    // ====== إدارة المنتجات ======
    Route::get('/admin/products', [ProductController::class, 'index'])
        ->name('products.index')->middleware(['auth', 'admin']);

    Route::get('/admin/products/create', [ProductController::class, 'create'])
        ->name('products.create')->middleware(['auth', 'admin']);

    Route::post('/admin/products', [ProductController::class, 'store'])
        ->name('products.store')->middleware(['auth', 'admin']);

    Route::delete('/admin/products/{id}', [ProductController::class, 'destroy'])
        ->name('products.destroy')->middleware(['auth', 'admin']);

    Route::get('/admin/products/{id}/edit', [ProductController::class, 'edit'])
        ->name('products.edit')->middleware(['auth', 'admin']);

    Route::put('/admin/products/{id}', [ProductController::class, 'update'])
    ->name('products.update')->middleware(['auth', 'admin']);


    // ====== إدارة خصومات المنتجات ======
    Route::get('/admin/products/{id}/discount', [ProductController::class, 'editDiscount'])
    ->name('products.discount.edit')->middleware(['auth', 'admin']);
    Route::post('/admin/products/{id}/discount', [ProductController::class, 'updateDiscount'])
    ->name('products.discount.update')->middleware(['auth', 'admin']);
});


Route::middleware(['auth', 'admin'])->group(function () {

    // صفحة الداش بورد
    Route::get('/admin', function () {
        return view('admin.dashboard');
    })->name('admin.dashboard');

});


