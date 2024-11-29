<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Classroom extends Model
{
    use HasFactory;

    protected $table = 'classrooms';
    protected $fillable = ['name'];

    public function timetables()
    {
        return $this->hasMany(Timetable::class, 'class_id');
    }

    public function students()
    {
        return $this->hasMany(Student::class, 'classroom_id', 'id');
    }
}
