<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'dob',
        'course',
        'class',
        'teacher',
        'parent_id',
        'classroom_id'
    ];

    public function parent()
    {
        return $this->belongsTo(ParentModel::class, 'parent_id');
    }
    public function classroom()
    {
        return $this->belongsTo(Classroom::class);
    }

    public function timetables()
    {
        return $this->hasManyThrough(Timetable::class, Classroom::class, 'classroom_id', 'class_id');
    }
}
