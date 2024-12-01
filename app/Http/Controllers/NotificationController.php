<?php

namespace App\Http\Controllers;

use App\Models\Notification;
use Illuminate\Http\Request;

class NotificationController extends Controller
{
    public function index()
    {
        $notifications = Notification::where('user_id', auth()->id())->get();
        return view('notifications.index', compact('notifications'));
    }

    public function markAsRead($id)
    {
        $notification = Notification::findOrFail($id);

        if ($notification->user_id !== auth()->id()) {
            abort(403, 'Unauthorized access to this notification.');
        }

        $notification->update(['updated_at' => now()]);

        return redirect()->back()->with('success', 'Notification marked as read.');
    }

    public function destroy($id)
    {
        $notification = Notification::findOrFail($id);

        if ($notification->user_id !== auth()->id()) {
            abort(403, 'Unauthorized access to this notification.');
        }

        $notification->delete();

        return redirect()->back()->with('success', 'Notification deleted successfully.');
    }

    public static function createNotification($userId, $title, $message, $courseId = null, $contentId = null)
{
    Notification::create([
        'user_id' => $userId,
        'title' => $title,
        'message' => $message,
        'course_id' => $courseId,
        'content_id' => $contentId,
    ]);
}
}
