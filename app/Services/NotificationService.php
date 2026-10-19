<?php

namespace App\Services;

use App\Models\Customer;
use App\Models\Order;
use App\Models\Product;
use App\Models\User;
use App\Notifications\NewCustomer;
use App\Notifications\OrderStatusChanged;
use App\Notifications\LowStockAlert;
use App\Notifications\NewOrderReceived;
use Illuminate\Support\Facades\Notification;
use Carbon\Carbon;

class NotificationService
{
    /**
     * Send new customer notification to admins
     */
    public function notifyNewCustomer(Customer $customer)
    {
        $admins = User::where('status', 'active')->get();
        
        foreach ($admins as $admin) {
            $admin->notify(new NewCustomer($customer));
        }

        return [
            'success' => true,
            'admins_notified' => $admins->count(),
        ];
    }

    /**
     * Send new order notification to admins
     */
    public function notifyNewOrder(Order $order)
    {
        $admins = User::where('status', 'active')->get();
        
        foreach ($admins as $admin) {
            $admin->notify(new NewOrderReceived($order));
        }

        // Also notify the customer
        $order->customer->notify(new OrderStatusChanged($order));

        return [
            'success' => true,
            'admins_notified' => $admins->count(),
            'customer_notified' => true,
        ];
    }

    /**
     * Send order status change notification
     */
    public function notifyOrderStatusChanged(Order $order)
    {
        $order->customer->notify(new OrderStatusChanged($order));

        return [
            'success' => true,
            'customer_notified' => $order->customer->email,
        ];
    }

    /**
     * Send low stock alert to admins
     */
    public function notifyLowStock(Product $product)
    {
        $admins = User::where('status', 'active')->get();
        
        foreach ($admins as $admin) {
            $admin->notify(new LowStockAlert($product));
        }

        return [
            'success' => true,
            'admins_notified' => $admins->count(),
        ];
    }

    /**
     * Send bulk low stock alerts
     */
    public function checkAndNotifyLowStock()
    {
        $lowStockProducts = Product::where('stock', '<=', 10)
            ->where('stock', '>', 0)
            ->get();

        $outOfStock = Product::where('stock', '<=', 0)->get();

        $admins = User::where('status', 'active')->get();
        
        $notified = 0;
        
        foreach ($admins as $admin) {
            if ($lowStockProducts->count() > 0) {
                $admin->notify(new LowStockAlert($lowStockProducts->first(), [
                    'type' => 'low_stock',
                    'count' => $lowStockProducts->count(),
                    'products' => $lowStockProducts->take(5)->pluck('name')->toArray(),
                ]));
                $notified++;
            }

            if ($outOfStock->count() > 0) {
                $admin->notify(new LowStockAlert($outOfStock->first(), [
                    'type' => 'out_of_stock',
                    'count' => $outOfStock->count(),
                    'products' => $outOfStock->take(5)->pluck('name')->toArray(),
                ]));
                $notified++;
            }
        }

        return [
            'success' => true,
            'admins_notified' => $notified,
            'low_stock_count' => $lowStockProducts->count(),
            'out_of_stock_count' => $outOfStock->count(),
        ];
    }

    /**
     * Send custom notification to user
     */
    public function sendToUser($user, $title, $message, $type = 'info')
    {
        $user->notify(new \App\Notifications\CustomNotification([
            'title' => $title,
            'message' => $message,
            'type' => $type,
        ]));

        return [
            'success' => true,
            'user' => $user->email,
        ];
    }

    /**
     * Send email notification
     */
    public function sendEmailNotification($email, $subject, $message)
    {
        // This would typically use Laravel's Mail facade
        // For now, we'll just log it
        
        \Log::info("Email notification to {$email}", [
            'subject' => $subject,
            'message' => $message,
            'sent_at' => Carbon::now()->toIso8601String(),
        ]);

        return [
            'success' => true,
            'email' => $email,
            'subject' => $subject,
        ];
    }

    /**
     * Get unread notifications for user
     */
    public function getUnreadForUser($user, $limit = 10)
    {
        return $user->notifications()
            ->where('read_at', null)
            ->orderByDesc('created_at')
            ->limit($limit)
            ->get();
    }

    /**
     * Mark notification as read
     */
    public function markAsRead($user, $notificationId)
    {
        $notification = $user->notifications()->find($notificationId);
        
        if ($notification) {
            $notification->markAsRead();
            return ['success' => true];
        }

        return ['success' => false, 'error' => 'Notification not found'];
    }

    /**
     * Mark all notifications as read
     */
    public function markAllAsRead($user)
    {
        $user->unreadNotifications->markAsRead();
        
        return [
            'success' => true,
            'marked_count' => $user->notifications()->where('read_at', null)->count(),
        ];
    }

    /**
     * Get notification statistics
     */
    public function getStats($user)
    {
        $total = $user->notifications()->count();
        $unread = $user->notifications()->where('read_at', null)->count();
        $today = $user->notifications()->whereDate('created_at', today())->count();

        return [
            'total' => $total,
            'unread' => $unread,
            'today' => $today,
            'read' => $total - $unread,
        ];
    }

    /**
     * Clean old notifications
     */
    public function cleanOldNotifications($days = 30)
    {
        $cutoff = Carbon::now()->subDays($days);
        
        $deleted = $user->notifications()
            ->where('read_at', '!=', null)
            ->where('created_at', '<', $cutoff)
            ->delete();

        return [
            'success' => true,
            'deleted' => $deleted,
            'older_than_days' => $days,
        ];
    }
}
