<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Order;
use Carbon\Carbon;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail; // لو هتبعت ايميل
use App\Models\User; // لو هتبعت Notification للـ Admin
use App\Notifications\OrderExpired; // لو هتستخدم Notification

class CheckOrdersExpiration extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:check-orders-expiration';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
   public function handle()
{
    // جلب كل الأوردرات اللي مش منتهية واللي انتهت مدتها
    $orders = Order::where('is_expired', false)
                   ->where('expires_at', '<=', Carbon::now())
                   ->get();

    foreach ($orders as $order) {
        // تعديل الحالة
        $order->is_expired = true;
        $order->status = 'expired';
        $order->save();

        // مثال إرسال رسالة للـ Admin (Log)
        Log::info("Order {$order->order_number} انتهت مدته وبلغت الادمن");

        // لو عايز تبعت Notification داخل الموقع
        $admin = User::where('role', 'admin')->first();
        if($admin){
            $admin->notify(new OrderExpired($order));
        }

        // لو عايز تبعت إيميل للـ Admin
        // Mail::to($admin->email)->send(new \App\Mail\OrderExpiredMail($order));
    }

    $this->info('تم فحص جميع الأوردرات المنتهية.');
}
}
