<?php

namespace App\Http\Controllers;

use App\Models\Notification;
use App\Models\ParentModel;
use App\Models\Teacher;
use Illuminate\Http\Request;

class AdminNotificationController extends Controller
{
    // Hiển thị form gửi thông báo
    public function create()
    {
        $teachers = Teacher::select('id', 'name')->get();
        $parents = ParentModel::select('id', 'name')->get();

        return view('admin.notifications.create', compact('teachers', 'parents'));
    }

    // Gửi thông báo chung
    public function sendNotification(Request $request)
    {
        $request->validate([
            'recipient_type' => 'required|in:teacher,parent',
            'recipient_selection' => 'required|in:single,multiple,all',
            'recipients' => 'nullable|array',  // Validate mảng recipient
            'recipients.*' => 'integer',       // Validate từng ID là số nguyên
            'message' => 'required|string|max:255',
        ]);

        $model = $request->recipient_type === 'teacher' ? Teacher::class : ParentModel::class;

        // Kiểm tra danh sách người nhận
        $recipients = collect();

        if ($request->recipient_selection === 'single') {
            $recipients = $model::where('id', $request->recipients[0])->get();
        } elseif ($request->recipient_selection === 'multiple') {
            $recipients = $model::whereIn('id', $request->recipients)->get();
        } elseif ($request->recipient_selection === 'all') {
            $recipients = $model::all();
        }

        // Gửi thông báo
        foreach ($recipients as $recipient) {

            $notification = new Notification([
                'type' => 'App\Notifications\AdminNotification',
                'data' => json_encode(['message' => $request->message]),
                'notifiable_type' => get_class($recipient),
                'notifiable_id' => $recipient->id,
                'read_at' => null,
            ]);
            $recipient->notifications()->save($notification);
        }

        return back()->with('status', 'Thông báo đã được gửi thành công!');
    }
}
