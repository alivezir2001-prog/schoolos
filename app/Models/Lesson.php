<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Teacher;

class Lesson extends Model
{
   protected $fillable = [
        'school_id',
        'name',
        'active',
    ];

	public function teachers()
	{
	    return $this->belongsToMany(
	        Teacher::class,
	        'teacher_lesson'
	    );
	}
	
    public function school()
    {
        return $this->belongsTo(School::class);
    }
}
