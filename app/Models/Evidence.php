<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Evidence extends Model


{
    protected $table = 'evidence';

    protected $fillable = [
        'school_id',
        'student_id',
        'observer_id',
        'title',
        'description',
        'observed_at',
        'attachment_path',
    ];

    protected $casts = [
        'observed_at' => 'datetime',
    ];

    public function school(): BelongsTo
    {
        return $this->belongsTo(School::class);
    }

    public function student(): BelongsTo
    {
        return $this->belongsTo(Student::class);
    }

    public function observer(): BelongsTo
    {
        return $this->belongsTo(User::class, 'observer_id');
    }
}
