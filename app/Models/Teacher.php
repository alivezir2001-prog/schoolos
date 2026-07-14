<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Teacher extends Model
{
    protected $fillable = [
        'school_id',
        'first_name',
        'last_name',
        'tc_no',
        'branch',
        'phone',
        'email',
        'homeroom_class_id',
        'active',
    ];

    protected $appends = [
        'full_name',
    ];

    /*
    |--------------------------------------------------------------------------
    | Accessors
    |--------------------------------------------------------------------------
    */

    public function getFullNameAttribute(): string
    {
        return "{$this->first_name} {$this->last_name}";
    }

    /*
    |--------------------------------------------------------------------------
    | Relationships
    |--------------------------------------------------------------------------
    */

    public function school()
    {
        return $this->belongsTo(School::class);
    }

    public function lessons()
    {
        return $this->belongsToMany(
            Lesson::class,
            'teacher_lesson'
        );
    }

    public function homeroomClass()
    {
        return $this->belongsTo(
            SchoolClass::class,
            'homeroom_class_id'
        );
    }

    public function teachingAssignments()
    {
        return $this->hasMany(TeachingAssignment::class);
    }

    public function user()
    {
    return $this->belongsTo(User::class);
    }
}