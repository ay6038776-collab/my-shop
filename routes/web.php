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
use App\Http\Controllers\LanguageController;
use App\Http\Controllers\SettingsController;
use App\Http\Controllers\AdminNotificationController;

/*
|--------------------------------------------------------------------------
| Language Switch Route
|--------------------------------------------------------------------------
*/
Route::get('lang/{lang}', [LanguageController::class, 'switch'])->name('lang.switch');

/*
|--------------------------------------------------------------------------
| Admin Auth Routes (with rate limiting and brute force protection)
|--------------------------------------------------------------------------
*/
Route::middleware(['brute.force:login', 'input.sanitize'])->group(function () {
    Route::get('/admin/login', fn () => view('admin.login'))->name('login');
    Route::post('/admin/login', [AuthController::class, 'login'])->name('login.post');
    Route::get('/admin/register', fn () => view('admin.register'))->name('register');
    Route::post('/admin/register', [AuthController::class, 'register'])->name('register.post');
});

/*
|--------------------------------------------------------------------------
| Admin Routes (with enhanced security)
|--------------------------------------------------------------------------
*/
Route::prefix('admin')
    ->middleware(['enhanced.admin.auth'])
    ->group(function () {

    Route::get('/index', [DashboardController::class, 'index'])->name('admin.index');

    // Notifications
    Route::get('/notifications', [AdminNotificationController::class, 'index'])->name('admin.notifications');
    Route::post('/notifications/read/{id}', [AdminNotificationController::class, 'markAsRead'])->name('admin.notifications.read');
    Route::post('/notifications/read-all', [AdminNotificationController::class, 'markAllAsRead'])->name('admin.notifications.read-all');
    Route::delete('/notifications/{id}', [AdminNotificationController::class, 'destroy'])->name('admin.notifications.destroy');
    Route::delete('/notifications', [AdminNotificationController::class, 'clearAll'])->name('admin.notifications.clear');

    Route::get('/settings', [SettingsController::class, 'index'])->name('admin.settings');
    Route::post('/settings/update', [SettingsController::class, 'update'])->name('admin.settings.update');
    Route::post('/settings/clear-cache', [SettingsController::class, 'clearCache'])->name('admin.settings.clear-cache');
    Route::post('/settings/optimize', [SettingsController::class, 'optimize'])->name('admin.settings.optimize');
    Route::post('/settings/maintenance', [SettingsController::class, 'toggleMaintenance'])->name('admin.settings.maintenance');

    Route::get('/employees', [EmployeeController::class, 'index'])->name('admin.employees.index');
    Route::get('/employees/create', [EmployeeController::class, 'create'])->name('admin.employees.create');
    Route::post('/employees', [EmployeeController::class, 'store'])->name('admin.employees.store');
    Route::get('/employees/{id}/edit', [EmployeeController::class, 'edit'])->name('admin.employees.edit');
    Route::put('/employees/{id}', [EmployeeController::class, 'update'])->name('admin.employees.update');
    Route::delete('/employees/{id}', [EmployeeController::class, 'destroy'])->name('admin.employees.destroy');
    Route::post('/employees/{id}/toggle', [EmployeeController::class, 'toggleStatus'])->name('admin.employees.toggle');

    Route::resource('products', ProductController::class);
    // Route::get('/add-product', [ProductController::class, 'create'])->name('products.create');
    // Route::post('/add-product', [ProductController::class, 'store'])->name('products.store');

    Route::get('/videos', [VideoController::class, 'video'])->name('videos.video');
    
    Route::get('/videos/create', [VideoController::class, 'create'])->name('videos.create');
    Route::post('/videos', [VideoController::class, 'store'])->name('videos.store');
    Route::delete('/videos/{id}', [VideoController::class, 'destroy'])->name('videos.destroy');
    Route::post('/admin/settings/reset-products', [SettingsController::class, 'resetProducts'])
    ->name('admin.settings.reset-products');
    Route::post('/admin/settings/reset-videos', [SettingsController::class, 'resetVideos'])
    ->name('admin.settings.reset-videos');
    Route::post('/admin/settings/reset-employees', [SettingsController::class, 'resetEmployees'])
    ->name('admin.settings.reset-employees');
    Route::post('/admin/settings/reset-complaints', [SettingsController::class, 'resetComplaints'])
    ->name('admin.settings.reset-complaints');
    Route::post('/admin/settings/reset-orders', [SettingsController::class, 'resetOrders'])
    ->name('admin.settings.reset-orders');
    Route::post('/admin/settings/clear-orders', [SettingsController::class, 'resetOrders'])
    ->name('admin.settings.clear-orders');
    Route::post('/admin/settings/reset-ratings', [SettingsController::class, 'resetRatings'])
    ->name('admin.settings.reset-ratings');
    Route::post('/admin/settings/reset-all', [SettingsController::class, 'resetAll'])
    ->name('admin.settings.reset-all');
    Route::post('/admin/settings/backup', [SettingsController::class, 'backup'])->name('admin.settings.backup');    
    
    Route::get('/bulk', [BulkController::class, 'index'])->name('bulk');
    Route::post('/bulk-delete', [BulkController::class, 'destroy'])->name('bulk.destroy');
    Route::delete('/bulk-delete-products', [ProductController::class, 'bulkDelete'])->name('bulkDelete');

    Route::get('/complaints', [AdminComplaintController::class, 'index'])->name('admin.complaints.index');
    Route::get('/complaints/{id}', [AdminComplaintController::class, 'show'])->name('admin.complaints.show');
    Route::delete('/complaints/{id}', [AdminComplaintController::class, 'destroy'])->name('admin.complaints.destroy');

    Route::prefix('orders')->group(function () {
        Route::get('/', [OrderController::class, 'index'])->name('admin.orders.index');
        Route::post('/approve/{id}', [OrderController::class, 'approve'])->name('orders.approve');
        Route::post('/reject/{id}', [OrderController::class, 'reject'])->name('orders.reject');
    });

    Route::post('/admin/update-avatar', [AuthController::class, 'updateAvatar'])->name('admin.update.avatar');
    Route::post('/logout', [AuthController::class, 'logout'])->name('admin.logout');
    
});

/*
|--------------------------------------------------------------------------
| Admin Auth
|--------------------------------------------------------------------------
*/
Route::get('/admin/login', fn () => view('admin.login'))->name('login');
Route::post('/admin/login', [AuthController::class, 'login'])->name('login.post');
Route::get('/admin/register', fn () => view('admin.register'))->name('register');
Route::post('/admin/register', [AuthController::class, 'register'])->name('register.post');

/*
|--------------------------------------------------------------------------
| Customer Routes (with locale middleware)
|--------------------------------------------------------------------------
*/
Route::middleware('set.locale')->group(function () {

    Route::get('/', [ShowController::class, 'home']);
    Route::get('/show/home', [ShowController::class, 'home'])->name('home');

    Route::get('/products', [ShowController::class, 'products'])->name('show.products.index');
    Route::get('/products/search', [ShowController::class, 'ajaxSearch']);
    Route::get('/products/{id}', [ShowController::class, 'details'])->name('show.products.details');

    Route::post('/product/{id}/rate', [RatingController::class, 'store'])->name('rate.product')->middleware('customer.auth');

    Route::get('/videos', [VideoController::class, 'showVideos'])->name('videos.show');
    Route::get('/aboutus', [ShowController::class, 'about']);
    Route::get('/contact', [ContactController::class, 'index'])->name('contact.index');
    Route::post('/contact/send', [ContactController::class, 'send'])->name('contact.send');

    Route::get('/customer/login', [CustomerAuthController::class, 'showLoginForm'])->name('customer.login');
    Route::post('/customer/login', [CustomerAuthController::class, 'login'])->name('customer.login.submit');
    Route::post('/customer/logout', [CustomerAuthController::class, 'logout'])->name('customer.logout');
    Route::get('/customer/register', [CustomerAuthController::class, 'showRegisterForm'])->name('customer.register');
    Route::post('/customer/register', [CustomerAuthController::class, 'register'])->name('customer.register.submit');

    // Social Login Routes
    Route::get('/auth/google', [App\Http\Controllers\SocialLoginController::class, 'redirectToGoogle'])->name('auth.google');
    Route::get('/auth/google/callback', [App\Http\Controllers\SocialLoginController::class, 'handleGoogleCallback']);
    Route::get('/auth/facebook', [App\Http\Controllers\SocialLoginController::class, 'redirectToFacebook'])->name('auth.facebook');
    Route::get('/auth/facebook/callback', [App\Http\Controllers\SocialLoginController::class, 'handleFacebookCallback']);
    Route::get('/auth/twitter', [App\Http\Controllers\SocialLoginController::class, 'redirectToTwitter'])->name('auth.twitter');
    Route::get('/auth/twitter/callback', [App\Http\Controllers\SocialLoginController::class, 'handleTwitterCallback']);
    Route::get('/auth/apple', [App\Http\Controllers\SocialLoginController::class, 'redirectToApple'])->name('auth.apple');
    Route::get('/auth/apple/callback', [App\Http\Controllers\SocialLoginController::class, 'handleAppleCallback']);

    Route::middleware('customer.auth')->group(function () {
        Route::get('/profile', [ProfileController::class, 'index'])->name('profile');
        Route::post('/profile/update', [ProfileController::class, 'update'])->name('profile.update');

        Route::get('/show/orders', [OrderController::class, 'myOrders'])->name('customer.orders');
        Route::post('/orders/store', [OrderController::class, 'store'])->name('orders.store');
        Route::get('/orders/{id}/invoice', [OrderController::class, 'downloadInvoice'])->name('order.invoice');

        Route::get('/cart', [CartController::class, 'index'])->name('cart.index');
        Route::post('/cart/add/{id}', [CartController::class, 'add'])->name('cart.add');
        Route::put('/cart/update/{id}', [CartController::class, 'update'])->name('cart.update');
        Route::delete('/cart/remove/{id}', [CartController::class, 'remove'])->name('cart.remove');
        Route::delete('/cart/clear', [CartController::class, 'clear'])->name('cart.clear');

        Route::get('/checkout', [CheckoutController::class, 'index'])->name('checkout');
        Route::post('/checkout', [CheckoutController::class, 'store'])->name('checkout.store');
    });
});
