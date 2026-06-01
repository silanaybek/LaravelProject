<?php

use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\OrderController as AdminOrderController;
use App\Http\Controllers\Admin\ProductController as AdminProductController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProductController;
use Illuminate\Support\Facades\Route;

// Frontend
Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/urunler', [ProductController::class, 'index'])->name('products.index');
Route::get('/urunler/{slug}', [ProductController::class, 'show'])->name('products.show');
Route::get('/iletisim', [ContactController::class, 'index'])->name('contact');
Route::post('/iletisim', [ContactController::class, 'store'])->name('contact.store');

// Cart
Route::get('/sepet', [CartController::class, 'index'])->name('cart.index');
Route::post('/sepet/ekle', [CartController::class, 'add'])->name('cart.add');
Route::patch('/sepet/{cartItem}', [CartController::class, 'update'])->name('cart.update');
Route::delete('/sepet/{cartItem}', [CartController::class, 'remove'])->name('cart.remove');
Route::delete('/sepet', [CartController::class, 'clear'])->name('cart.clear');

// Checkout
Route::middleware('auth')->group(function () {
    Route::get('/siparis', [CheckoutController::class, 'index'])->name('checkout.index');
    Route::post('/siparis', [CheckoutController::class, 'store'])->name('checkout.store');
});

// Auth
Route::middleware('guest')->group(function () {
    Route::get('/giris', [LoginController::class, 'showLoginForm'])->name('login');
    Route::post('/giris', [LoginController::class, 'login']);
    Route::get('/kayit', [RegisterController::class, 'showRegisterForm'])->name('register');
    Route::post('/kayit', [RegisterController::class, 'register']);
});
Route::post('/cikis', [LoginController::class, 'logout'])->name('logout');

// Admin Panel
Route::prefix('admin')->name('admin.')->middleware(['auth', 'admin'])->group(function () {
    Route::get('/', [DashboardController::class, 'index'])->name('dashboard');

    Route::resource('kategoriler', CategoryController::class)->parameters(['kategoriler' => 'category'])
        ->names([
            'index'   => 'categories.index',
            'create'  => 'categories.create',
            'store'   => 'categories.store',
            'edit'    => 'categories.edit',
            'update'  => 'categories.update',
            'destroy' => 'categories.destroy',
        ]);

    Route::resource('urunler', AdminProductController::class)->parameters(['urunler' => 'product'])
        ->names([
            'index'   => 'products.index',
            'create'  => 'products.create',
            'store'   => 'products.store',
            'edit'    => 'products.edit',
            'update'  => 'products.update',
            'destroy' => 'products.destroy',
        ]);

    Route::get('siparisler', [AdminOrderController::class, 'index'])->name('orders.index');
    Route::get('siparisler/{order}', [AdminOrderController::class, 'show'])->name('orders.show');
    Route::patch('siparisler/{order}/durum', [AdminOrderController::class, 'updateStatus'])->name('orders.updateStatus');
    Route::delete('siparisler/{order}', [AdminOrderController::class, 'destroy'])->name('orders.destroy');

    Route::get('kullanicilar', [UserController::class, 'index'])->name('users.index');
    Route::get('kullanicilar/{user}', [UserController::class, 'show'])->name('users.show');
    Route::delete('kullanicilar/{user}', [UserController::class, 'destroy'])->name('users.destroy');
});
