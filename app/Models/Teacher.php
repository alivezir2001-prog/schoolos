<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\School;
use App\Models\Lesson;

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
}
