<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    protected $fillable = [
        'school_id',
        'school_class_id',
        'tc_no',
        'school_no',
        'first_name',
        'last_name',
        'gender',
        'birth_date',
        'active',
    ];

    public function school()
    {
        return $this->belongsTo(School::class);
    }

    public function schoolClass()
    {
        return $this->belongsTo(SchoolClass::class);
    }
}
