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
        'user_id',
    ];

    // Définir une relation avec le modèle Course
    public function course()
    {
        return $this->belongsTo(Course::class);
    }

    // Définir une relation avec le modèle User/instructor
    public function instructor()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    // Scope pour des filtres fréquents
    public function scopeActive($query)
    {
        return $query->where('status', 1)->where('coupon_validity', '>', now());
    }

    /**
     * Vérifie si le coupon est valide et applicable
     */
    public function isApplicableForCourse($courseId)
    {
        return $this->status == 1 &&
               $this->coupon_validity > now() &&
               ($this->course_id == null || $this->course_id == $courseId);
    }

    /**
     * Calcule la réduction basée sur le prix du cours
     */
    public function applyDiscount($price)
    {
        return max($price - ($price * $this->coupon_discount / 100), 0);

    }
}
