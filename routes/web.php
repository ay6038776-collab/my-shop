<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\VideoController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ShowController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CustomerAuthController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\AdminComplaintController;
use App\Http\Controllers\BulkController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\OrderController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Admin Routes
|--------------------------------------------------------------------------
*/
Route::prefix('admin')->group(function () {

    // صفحة الرئيسية للأدمن
    Route::get('/index', [DashboardController::class, 'index'])->name('admin.index');

    // إدارة المنتجات
    Route::resource('products', ProductController::class);
    Route::get('/add-product', [ProductController::class, 'create'])->name('products.create');
    Route::post('/add-product', [ProductController::class, 'store'])->name('products.store');

    // إدارة الفيديوهات
    Route::get('/videos', [VideoController::class, 'video'])->name('videos.vido');
    Route::get('/videos/create', [VideoController::class, 'create'])->name('videos.create');
    Route::post('/videos', [VideoController::class, 'store'])->name('videos.store');
    Route::delete('/videos/{id}', [VideoController::class, 'destroy'])->name('videos.destroy');

    // Bulk
    Route::get('/bulk', [BulkController::class, 'index'])->name('bulk');
    Route::post('/bulk-delete', [BulkController::class, 'destroy'])->name('bulk.destroy');
    Route::delete('bulk-delete', [ProductController::class, 'bulkDelete'])->name('bulkDelete');

    // شكاوى الأدمن
    Route::prefix('/')->name('admin.')->group(function () {
        Route::get('/complaints', [AdminComplaintController::class, 'index'])->name('complaints.index');
        Route::get('/complaints/{id}', [AdminComplaintController::class, 'show'])->name('complaints.show');
        Route::delete('/complaints/{id}', [AdminComplaintController::class, 'destroy'])->name('complaints.destroy');
    });

    // Auth الأدمن
    Route::get('/login', fn() => view('admin.login'))->name('login');
    Route::post('/login', [AuthController::class, 'login'])->name('login.post');
    Route::get('/register', fn() => view('admin.register'))->name('register');
    Route::post('/register', [AuthController::class, 'register'])->name('register.post');
    Route::post('/logout', [AuthController::class, 'logout'])->name('admin.logout');

    Route::middleware('auth')->group(function () {
        Route::get('/dashboard', fn() => view('admin.dashboard'))->name('dashboard');
    });

    // Orders الأدمن
    Route::get('/orders', [OrderController::class, 'index'])->name('admin.orders.index');
    // Orders الأدمن
Route::prefix('orders')->middleware('auth')->group(function () {
    Route::get('/', [OrderController::class, 'index'])->name('admin.orders.index');

    // موافقة الطلب
    Route::post('/approve/{id}', [OrderController::class, 'approve'])->name('orders.approve');

    // رفض الطلب
    Route::post('/reject/{id}', [OrderController::class, 'reject'])->name('orders.reject');
});
});


/*
|--------------------------------------------------------------------------
| Customer Routes
|--------------------------------------------------------------------------
*/

// الصفحة الرئيسية والكورسات والمنتجات
Route::get('/', [ShowController::class, 'home']);
Route::get('/show/home', [ShowController::class, 'home'])->name('home');
Route::get('/products', [ShowController::class, 'products'])->name('show.products.index');
Route::get('/products/{id}', [ShowController::class, 'details'])->name('show.products.details');
Route::get('/videos', [VideoController::class, 'showVideos'])->name('videos.show');
Route::get('/aboutus', [ShowController::class, 'about']);
Route::get('/contact', [ContactController::class, 'index'])->name('contact.index');
Route::post('/contact/send', [ContactController::class, 'send'])->name('contact.send');

// Customer Auth
Route::get('/customer/login', [CustomerAuthController::class, 'showLoginForm'])->name('customer.login');
Route::post('/customer/login', [CustomerAuthController::class, 'login'])->name('customer.login.submit');
Route::post('/customer/logout', [CustomerAuthController::class, 'logout'])->name('customer.logout');
Route::get('/customer/register', [CustomerAuthController::class, 'showRegisterForm'])->name('customer.register');
Route::post('/customer/register', [CustomerAuthController::class, 'register'])->name('customer.register.submit');


// Customer Profile
Route::middleware('customer.auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'index'])->name('profile');
    Route::post('/profile/update', [ProfileController::class, 'update'])->name('profile.update');

    // Orders
    Route::get('/show/orders', [OrderController::class, 'myOrders'])->name('customer.orders');
    Route::post('/orders/store', [OrderController::class, 'store'])->name('orders.store');

    // Cart & Checkout
    Route::get('/cart', [CartController::class, 'index'])->name('cart.index');
    Route::post('/cart/add/{id}', [CartController::class, 'add'])->name('cart.add');
    Route::put('/cart/update/{id}', [CartController::class, 'update'])->name('cart.update');
    Route::delete('/cart/remove/{id}', [CartController::class, 'remove'])->name('cart.remove');
    Route::delete('/cart/clear', [CartController::class, 'clear'])->name('cart.clear');

    Route::get('/checkout', [CheckoutController::class, 'index'])->name('checkout');
    Route::post('/checkout', [CheckoutController::class, 'store'])->name('checkout.store');
});
