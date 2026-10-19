<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminNotificationController extends Controller
{
    // Get all notifications (for dropdown/popup)
    public function index()
    {
        $user = Auth::user();
        $notifications = $user->unreadNotifications()
            ->orderBy('created_at', 'desc')
            ->take(20)
            ->get();

        return response()->json([
            'count' => $user->unreadNotifications()->count(),
            'notifications' => $notifications->map(function ($n) {
                return [
                    'id' => $n->id,
                    'type' => class_basename($n->type),
                    'message' => $n->data['message'] ?? 'New notification',
                    'icon' => $n->data['icon'] ?? 'bell',
                    'icon_color' => $n->data['icon_color'] ?? '#4f46e5',
                    'link' => $n->data['link'] ?? null,
                    'created_at' => $n->created_at->diffForHumans(),
                ];
            })
        ]);
    }

    // Mark single notification as read
    public function markAsRead($id)
    {
        $user = Auth::user();
        $notification = $user->unreadNotifications()->where('id', $id)->first();

        if ($notification) {
            $notification->markAsRead();
        }

        return response()->json(['success' => true]);
    }

    // Mark ALL notifications as read
    public function markAllAsRead()
    {
        $user = Auth::user();
        $user->unreadNotifications->markAsRead();

        return response()->json(['success' => true]);
    }

    // Delete (clear) a single notification
    public function destroy($id)
    {
        $user = Auth::user();
        $notification = $user->notifications()->where('id', $id)->first();

        if ($notification) {
            $notification->delete();
        }

        return response()->json(['success' => true]);
    }

    // Clear all notifications
    public function clearAll()
    {
        $user = Auth::user();
        $user->notifications()->delete();

        return response()->json(['success' => true]);
    }
}
