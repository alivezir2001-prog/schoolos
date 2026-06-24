<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ClassSchedule extends Model
{
    protected $fillable = [
        'school_id',
        'class_id',
        'lesson_id',
        'teacher_id',
        'day_of_week',
        'period',
    ];

    public function school()
    {
        return $this->belongsTo(School::class);
    }

    public function schoolClass()
    {
        return $this->belongsTo(SchoolClass::class, 'class_id');
    }

    public function lesson()
    {
        return $this->belongsTo(Lesson::class);
    }

    public function teacher()
    {
        return $this->belongsTo(Teacher::class);
    }
}
