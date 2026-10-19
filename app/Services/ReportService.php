<?php

namespace App\Services;

use App\Models\Customer;
use App\Models\Product;
use App\Models\Order;
use App\Models\Rating;
use App\Models\Employee;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class ReportService
{
    /**
     * Get dashboard statistics
     */
    public function getDashboardStats()
    {
        return [
            'customers' => [
                'total' => Customer::count(),
                'new_today' => Customer::whereDate('created_at', today())->count(),
                'new_this_week' => Customer::whereWeek('created_at', Carbon::now()->weekOfYear)->count(),
                'new_this_month' => Customer::whereMonth('created_at', Carbon::now()->month)->count(),
            ],
            'products' => [
                'total' => Product::count(),
                'active' => Product::where('status', 'active')->count(),
                'out_of_stock' => Product::where('stock', '<=', 0)->count(),
            ],
            'orders' => [
                'total' => Order::count(),
                'pending' => Order::where('status', 'pending')->count(),
                'processing' => Order::where('status', 'processing')->count(),
                'completed' => Order::where('status', 'completed')->count(),
                'cancelled' => Order::where('status', 'cancelled')->count(),
                'today' => Order::whereDate('created_at', today())->count(),
                'this_week' => Order::whereWeek('created_at', Carbon::now()->weekOfYear)->count(),
                'this_month' => Order::whereMonth('created_at', Carbon::now()->month)->count(),
            ],
            'revenue' => [
                'total' => Order::where('status', '!=', 'cancelled')->sum('total'),
                'today' => Order::whereDate('created_at', today())->where('status', '!=', 'cancelled')->sum('total'),
                'this_week' => Order::whereWeek('created_at', Carbon::now()->weekOfYear)->where('status', '!=', 'cancelled')->sum('total'),
                'this_month' => Order::whereMonth('created_at', Carbon::now()->month)->where('status', '!=', 'cancelled')->sum('total'),
            ],
            'ratings' => [
                'total' => Rating::count(),
                'average' => Rating::avg('rating') ?? 0,
            ],
        ];
    }

    /**
     * Get sales report
     */
    public function getSalesReport($startDate = null, $endDate = null)
    {
        $start = $startDate ? Carbon::parse($startDate) : Carbon::now()->startOfMonth();
        $end = $endDate ? Carbon::parse($endDate) : Carbon::now()->endOfMonth();

        $orders = Order::whereBetween('created_at', [$start, $end])
            ->where('status', '!=', 'cancelled')
            ->get();

        return [
            'period' => [
                'start' => $start->toDateString(),
                'end' => $end->toDateString(),
                'days' => $start->diffInDays($end) + 1,
            ],
            'summary' => [
                'total_orders' => $orders->count(),
                'total_revenue' => $orders->sum('total'),
                'average_order' => $orders->count() > 0 ? $orders->sum('total') / $orders->count() : 0,
                'total_items' => $orders->sum('quantity'),
            ],
            'daily' => $this->getDailySales($start, $end),
            'top_products' => $this->getTopProducts($start, $end, 10),
            'top_customers' => $this->getTopCustomers($start, $end, 10),
        ];
    }

    /**
     * Get daily sales breakdown
     */
    protected function getDailySales($start, $end)
    {
        $daily = [];
        
        for ($date = $start->copy(); $date <= $end; $date->addDay()) {
            $dayOrders = Order::whereDate('created_at', $date)
                ->where('status', '!=', 'cancelled')
                ->get();
            
            $daily[] = [
                'date' => $date->toDateString(),
                'day_name' => $date->format('l'),
                'orders' => $dayOrders->count(),
                'revenue' => $dayOrders->sum('total'),
            ];
        }

        return $daily;
    }

    /**
     * Get top selling products
     */
    protected function getTopProducts($start, $end, $limit = 10)
    {
        return DB::table('order_items')
            ->join('orders', 'order_items.order_id', '=', 'orders.id')
            ->join('products', 'order_items.product_id', '=', 'products.id')
            ->whereBetween('orders.created_at', [$start, $end])
            ->where('orders.status', '!=', 'cancelled')
            ->select(
                'products.id',
                'products.name',
                'products.image',
                DB::raw('SUM(order_items.quantity) as total_sold'),
                DB::raw('SUM(order_items.quantity * order_items.price) as total_revenue')
            )
            ->groupBy('products.id', 'products.name', 'products.image')
            ->orderByDesc('total_sold')
            ->limit($limit)
            ->get();
    }

    /**
     * Get top customers by spending
     */
    protected function getTopCustomers($start, $end, $limit = 10)
    {
        return DB::table('orders')
            ->join('customers', 'orders.customer_id', '=', 'customers.id')
            ->whereBetween('orders.created_at', [$start, $end])
            ->where('orders.status', '!=', 'cancelled')
            ->select(
                'customers.id',
                'customers.name',
                'customers.email',
                DB::raw('COUNT(orders.id) as total_orders'),
                DB::raw('SUM(orders.total) as total_spent')
            )
            ->groupBy('customers.id', 'customers.name', 'customers.email')
            ->orderByDesc('total_spent')
            ->limit($limit)
            ->get();
    }

    /**
     * Get product performance report
     */
    public function getProductPerformance()
    {
        $products = Product::withCount([
            'ratings as ratings_avg_rating' => function ($query) {
                $query->select(DB::raw('coalesce(avg(rating), 0)'));
            }
        ])
        ->withCount('orders as orders_count')
        ->with(['ratings', 'category'])
        ->get();

        return $products->map(function ($product) {
            return [
                'id' => $product->id,
                'name' => $product->name,
                'category' => $product->category->name ?? 'Uncategorized',
                'price' => $product->price,
                'stock' => $product->stock,
                'orders_count' => $product->orders_count,
                'ratings_count' => $product->ratings_count,
                'ratings_avg' => round($product->ratings_avg_rating ?? 0, 1),
                'revenue' => $product->orders_count > 0 
                    ? DB::table('order_items')
                        ->where('product_id', $product->id)
                        ->whereHas('order', function ($q) {
                            $q->where('status', '!=', 'cancelled');
                        })
                        ->sum(DB::raw('quantity * price'))
                    : 0,
            ];
        })->sortByDesc('orders_count');
    }

    /**
     * Get customer analytics
     */
    public function getCustomerAnalytics()
    {
        $customers = Customer::withCount('orders')
            ->withSum('orders', 'total')
            ->get();

        $totalSpent = $customers->sum('orders_sum_total') ?? 0;
        $avgSpent = $customers->count() > 0 ? $totalSpent / $customers->count() : 0;

        return [
            'total_customers' => $customers->count(),
            'active_customers' => $customers->filter(function ($c) {
                return $c->orders_count > 0;
            })->count(),
            'total_revenue_from_customers' => $totalSpent,
            'average_spent_per_customer' => $avgSpent,
            'top_customers' => $customers->sortByDesc('orders_sum_total')->take(10),
            'customers_by_orders' => [
                'none' => $customers->filter(fn($c) => $c->orders_count == 0)->count(),
                '1_to_5' => $customers->filter(fn($c) => $c->orders_count >= 1 && $c->orders_count <= 5)->count(),
                '6_to_10' => $customers->filter(fn($c) => $c->orders_count >= 6 && $c->orders_count <= 10)->count(),
                '10_plus' => $customers->filter(fn($c) => $c->orders_count > 10)->count(),
            ],
        ];
    }

    /**
     * Get inventory report
     */
    public function getInventoryReport()
    {
        $products = Product::with('category')->get();

        return [
            'total_products' => $products->count(),
            'total_value' => $products->sum(DB::raw('price * stock')),
            'in_stock' => $products->filter(fn($p) => $p->stock > 10)->count(),
            'low_stock' => $products->filter(fn($p) => $p->stock > 0 && $p->stock <= 10)->count(),
            'out_of_stock' => $products->filter(fn($p) => $p->stock <= 0)->count(),
            'low_stock_products' => $products->filter(fn($p) => $p->stock <= 10 && $p->stock > 0)->values(),
            'out_of_stock_products' => $products->filter(fn($p) => $p->stock <= 0)->values(),
        ];
    }

    /**
     * Export report to array (for PDF/Excel)
     */
    public function exportToArray($reportType, $params = [])
    {
        return match($reportType) {
            'sales' => $this->getSalesReport($params['start'] ?? null, $params['end'] ?? null),
            'products' => $this->getProductPerformance(),
            'customers' => $this->getCustomerAnalytics(),
            'inventory' => $this->getInventoryReport(),
            'dashboard' => $this->getDashboardStats(),
            default => [],
        };
    }
}
