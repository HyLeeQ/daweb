<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use App\Models\User;

class Teacher extends Model
{
    use HasFactory, Notifiable;

    protected $fillable = [
        'user_id', 'name', 'email', 'phone', 'dob', 'course', 'subject', 'address'
    ];

    // Quan hệ ngược lại với User
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function notifications()
    {
        return $this->morphMany(Notification::class, 'notifiable');
    }
}
