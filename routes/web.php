<?php

use Illuminate\Support\Facades\Route;

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
use App\Http\Controllers\RatingController;
use App\Http\Controllers\EmployeeController;

/*
|--------------------------------------------------------------------------
| Admin Routes
|--------------------------------------------------------------------------
*/
Route::prefix('admin')->middleware('auth')->group(function () {

    // Dashboard
    Route::get('/index', [DashboardController::class, 'index'])->name('admin.index');

    // Employees ✅ (اتصلحت)
    Route::get('/employees', [EmployeeController::class, 'index'])
        ->name('admin.employees.index');
        Route::get('/admin/employees/create', [EmployeeController::class, 'create'])
        ->name('admin.employees.create');

    Route::post('/admin/employees', [EmployeeController::class, 'store'])
        ->name('admin.employees.store');

    /*
    | Products
    */
    Route::resource('products', ProductController::class);
    Route::get('/add-product', [ProductController::class, 'create'])->name('products.create');
    Route::post('/add-product', [ProductController::class, 'store'])->name('products.store');

    /*
    | Videos
    */
    Route::get('/videos', [VideoController::class, 'video'])->name('videos.video');
    Route::get('/videos/create', [VideoController::class, 'create'])->name('videos.create');
    Route::post('/videos', [VideoController::class, 'store'])->name('videos.store');
    Route::delete('/videos/{id}', [VideoController::class, 'destroy'])->name('videos.destroy');

    /*
    | Bulk
    */
    Route::get('/bulk', [BulkController::class, 'index'])->name('bulk');
    Route::post('/bulk-delete', [BulkController::class, 'destroy'])->name('bulk.destroy');
    Route::delete('/bulk-delete-products', [ProductController::class, 'bulkDelete'])->name('bulkDelete');

    /*
    | Complaints
    */
    Route::get('/complaints', [AdminComplaintController::class, 'index'])->name('admin.complaints.index');
    Route::get('/complaints/{id}', [AdminComplaintController::class, 'show'])->name('admin.complaints.show');
    Route::delete('/complaints/{id}', [AdminComplaintController::class, 'destroy'])->name('admin.complaints.destroy');

    /*
    | Orders
    */
    Route::prefix('orders')->group(function () {
        Route::get('/', [OrderController::class, 'index'])->name('admin.orders.index');
        Route::post('/approve/{id}', [OrderController::class, 'approve'])->name('orders.approve');
        Route::post('/reject/{id}', [OrderController::class, 'reject'])->name('orders.reject');
    });

    // Logout
    Route::post('/logout', [AuthController::class, 'logout'])->name('admin.logout');
});

/*
|--------------------------------------------------------------------------
| Admin Auth (بدون auth middleware)
|--------------------------------------------------------------------------
*/
Route::get('/admin/login', fn () => view('admin.login'))->name('login');
Route::post('/admin/login', [AuthController::class, 'login'])->name('login.post');

Route::get('/admin/register', fn () => view('admin.register'))->name('register');
Route::post('/admin/register', [AuthController::class, 'register'])->name('register.post');


/*
|--------------------------------------------------------------------------
| Customer Routes
|--------------------------------------------------------------------------
*/
Route::get('/', [ShowController::class, 'home']);
Route::get('/show/home', [ShowController::class, 'home'])->name('home');

Route::get('/products', [ShowController::class, 'products'])->name('show.products.index');
Route::get('/products/search', [ShowController::class, 'ajaxSearch']);
Route::get('/products/{id}', [ShowController::class, 'details'])->name('show.products.details');

Route::post('/product/{id}/rate', [RatingController::class, 'store'])
    ->name('rate.product')
    ->middleware('auth');

Route::get('/videos', [VideoController::class, 'showVideos'])->name('videos.show');
Route::get('/aboutus', [ShowController::class, 'about']);

Route::get('/contact', [ContactController::class, 'index'])->name('contact.index');
Route::post('/contact/send', [ContactController::class, 'send'])->name('contact.send');

/*
|--------------------------------------------------------------------------
| Customer Auth
|--------------------------------------------------------------------------
*/
Route::get('/customer/login', [CustomerAuthController::class, 'showLoginForm'])->name('customer.login');
Route::post('/customer/login', [CustomerAuthController::class, 'login'])->name('customer.login.submit');
Route::post('/customer/logout', [CustomerAuthController::class, 'logout'])->name('customer.logout');

Route::get('/customer/register', [CustomerAuthController::class, 'showRegisterForm'])->name('customer.register');
Route::post('/customer/register', [CustomerAuthController::class, 'register'])->name('customer.register.submit');

/*
|--------------------------------------------------------------------------
| Customer Protected
|--------------------------------------------------------------------------
*/
Route::middleware('customer.auth')->group(function () {

    Route::get('/profile', [ProfileController::class, 'index'])->name('profile');
    Route::post('/profile/update', [ProfileController::class, 'update'])->name('profile.update');

    Route::get('/show/orders', [OrderController::class, 'myOrders'])->name('customer.orders');
    Route::post('/orders/store', [OrderController::class, 'store'])->name('orders.store');

    // Cart
    Route::get('/cart', [CartController::class, 'index'])->name('cart.index');
    Route::post('/cart/add/{id}', [CartController::class, 'add'])->name('cart.add');
    Route::put('/cart/update/{id}', [CartController::class, 'update'])->name('cart.update');
    Route::delete('/cart/remove/{id}', [CartController::class, 'remove'])->name('cart.remove');
    Route::delete('/cart/clear', [CartController::class, 'clear'])->name('cart.clear');

    // Checkout
    Route::get('/checkout', [CheckoutController::class, 'index'])->name('checkout');
    Route::post('/checkout', [CheckoutController::class, 'store'])->name('checkout.store');
});