<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Lesson extends Model
{
    protected $fillable = [
        'title',
        'content',
        'lesson_order',
        'course_id',
        'user_id',
    ];

    public function course(): BelongsTo
    {
        return $this->belongsTo(Course::class);
    }
}
