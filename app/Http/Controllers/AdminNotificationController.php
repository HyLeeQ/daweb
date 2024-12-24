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

    /**
     * Lấy tất cả thông báo đã gửi bởi admin.
     *
     * @return \Illuminate\Http\JsonResponse
     */

     public function getAdminNotifications(){
        $notifications = Notification::where('type', 'LIKE', '%AdminNotification%')->orderBy('created_at', 'desc')->get();
       
        return response()->json([
            'status' => 'success',
            'data' => $notifications
        ]);
     }

     public function showAdminNotifications(){
        $notifications = $this->getAdminNotifications()->original['data'];

        return view('admin.notifications.index', compact('notifications'));
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
        
        // Kiểm tra nếu gửi cho tất cả
        if ($request->recipient_selection === 'all') {
            $notification = new Notification([
                'type' => 'App\Notifications\AdminNotification',
                'data' => json_encode(['message' => $request->message]),
                'notifiable_type' => $model, // Loại đối tượng (Teacher hoặc ParentModel)
                'notifiable_id' => 0, // Đánh dấu là dành cho tất cả
                'read_at' => null,
            ]);
            $notification->save();
        } else {
            // Kiểm tra danh sách người nhận cho single/multiple
            $recipients = collect();
    
            if ($request->recipient_selection === 'single') {
                $recipients = $model::where('id', $request->recipients[0])->get();
            } elseif ($request->recipient_selection === 'multiple') {
                $recipients = $model::whereIn('id', $request->recipients)->get();
            }
    
            // Gửi thông báo cho từng người
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
        }
    
        return redirect()->route('admin.notification.index')->with('status', 'Thông báo đã được gửi thành công!');
    }
    
}
