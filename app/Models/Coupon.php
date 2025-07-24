<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Coupon extends Model
{
    use HasFactory;

    protected $fillable = [
        'coupon_name',
        'coupon_discount',
        'coupon_validity',
        'status',
        'course_id',
        'instructor_id',
    ];

    // Définir une relation avec le modèle Course
    public function course()
    {
        return $this->belongsTo(Course::class);
    }

    // Définir une relation avec le modèle User/instructor
    public function instructor()
    {
        return $this->belongsTo(User::class, 'instructor_id');
    }

    // Scope pour des filtres fréquents
    public function scopeActive($query)
    {
        return $query->where('status', 1)->where('coupon_validity', '>', now());
    }
}
