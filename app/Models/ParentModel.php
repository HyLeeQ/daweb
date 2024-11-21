<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use App\Models\User;

class ParentModel extends Model
{
    use Notifiable, HasFactory;
    protected $table = 'parents'; // Đảm bảo bảng đúng

    protected $fillable = [
        'user_id', 'name', 'email', 'phone', 'child_name'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function students(){
        return $this->hasMany(Student::class, 'parent_id');
    }

    public function notifications()
    {
        return $this->morphMany(Notification::class, 'notifiable');
    }
}
