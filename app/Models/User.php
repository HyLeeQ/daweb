<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
// use App\Models\Teacher;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $fillable = [
        'name',
        'phone',
        'email',
        'password',
        'role'
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',

    ];

    // Quan hệ với model Teacher
    public function teacher()
    {
        return $this->hasOne(Teacher::class, 'user_id');
    }

    // Kiểm tra xem user có phải là giáo viên không
    public function isTeacher()
    {
        return $this->teacher()->exists();
    }
    public function notifications()
    {
        return $this->morphMany(Notification::class, 'notifiable');
    }
    public function parent()
    {
        return $this->hasOne(ParentModel::class);
    }
}
