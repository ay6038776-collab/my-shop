<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Customer;
use App\Models\Order;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        $admin = Auth::guard('admin')->user();

        // Stats
        $productsCount = Product::count();
        $customersCount = Customer::count();
        $ordersCount = Order::count();
        $ordersPending = Order::where('status', 'pending')->count();
        $ordersApproved = Order::where('status', 'approved')->count();
        $totalRevenue = Order::where('status', 'approved')->sum('total_price');
        $totalValue = Product::sum('price');

        // Recent Products
        $latestProducts = Product::orderBy('created_at', 'desc')->take(10)->get();

        // Recent Orders
        $recentOrders = Order::with(['customer', 'items.product'])
            ->orderBy('created_at', 'desc')
            ->take(10)
            ->get();

        // Low Stock Products
        $lowStockProducts = Product::where('stock', '<', 5)
            ->where('stock', '>', 0)
            ->orderBy('stock', 'asc')
            ->take(5)
            ->get();

        // Monthly Orders (last 6 months)
        $monthlyOrders = Order::where('created_at', '>=', Carbon::now()->subMonths(6))
            ->selectRaw("DATE_FORMAT(created_at, '%Y-%m') as month, COUNT(*) as count, SUM(total_price) as revenue")
            ->groupBy('month')
            ->orderBy('month', 'asc')
            ->get();

        // Notifications
        $notifications = $admin->unreadNotifications
            ->sortByDesc('created_at')
            ->take(5);
        $notificationsCount = $admin->unreadNotifications()->count();

        return view('admin.index', compact(
            'productsCount',
            'customersCount',
            'ordersCount',
            'ordersPending',
            'ordersApproved',
            'totalRevenue',
            'totalValue',
            'latestProducts',
            'recentOrders',
            'lowStockProducts',
            'monthlyOrders',
            'notifications',
            'notificationsCount'
        ));
    }
}
