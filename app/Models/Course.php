<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'slug',
        'description',
        'thumbnail',
        'duration_hours',
        'level',
        'status',
        'price',
        'is_approved',
        'category_id',
        'user_id',
        'admin_id',
        'has_certificate',
    ];

    // Relations existantes
    public function category()
    {
        return $this->belongsTo(Category::class);
    }
    public function admin()
    {
        return $this->belongsTo(Admin::class, 'admin_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function lessons()
    {
        return $this->hasMany(Lesson::class);
    }

    public function ratings()
    {
        return $this->hasMany(Rating::class);
    }

    public function averageRating()
    {
        return $this->ratings()->avg('rating');
    }

    public function ratingsCount()
    {
        return $this->ratings()->count();
    }

    public function getUserRating($userId)
    {
        return $this->ratings()->where('user_id', $userId)->first();
    }


    protected $casts = [
        'is_approved' => 'string',
        'has_certificate' => 'boolean',
        'price' => 'decimal:2',
        'duration_hours' => 'float',
    ];

}
