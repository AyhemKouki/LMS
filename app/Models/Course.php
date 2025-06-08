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

    public function reviews()
    {
        return $this->hasMany(Review::class);
    }

    protected $casts = [
        'is_approved' => 'string',
        'has_certificate' => 'boolean',
        'price' => 'decimal:2',
        'duration_hours' => 'float',
    ];

}
