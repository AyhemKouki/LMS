<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OrderCourse extends Model
{
    protected $fillable = [
        'order_id',
        'course_id',
        'quantity',
        'price',
    ];
}
