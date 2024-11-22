<?php

// app/Models/Timetable.php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Timetable extends Model
{
    use HasFactory;

    protected $fillable = ['class_id', 'time_slot', 'day_of_week', 'teacher_id'];

    public function class()
    {
        return $this->belongsTo(Classroom::class);
    }

    public function teacher()
    {
        return $this->belongsTo(Teacher::class, 'teacher_id');
    }
    public function classroom()
    {
        return $this->belongsTo(Classroom::class, 'class_id');
    }
    public function students(){
        return $this->belongsTo(Student::class);
    }
}

