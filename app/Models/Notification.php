<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Notification extends Model
{
    protected $keyType = 'string'; // Nếu dùng UUID, kiểu dữ liệu là string
    public $incrementing = false; // Đảm bảo không tự động tăng giá trị của ID

    // Các trường có thể được gán
    protected $fillable = ['type', 'data', 'notifiable_type', 'notifiable_id', 'created_at', 'updated_at', 'read_at'];

    // Tự động gán UUID cho trường `id`
    protected static function booted()
    {
        static::creating(function ($notification) {
            if (!$notification->id) {
                $notification->id = (string) Str::uuid(); // Gán UUID cho trường `id`
            }
        });
    }
}
