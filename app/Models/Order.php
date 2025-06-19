<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $fillable = [
        'user_id',
        'amount',
        'status',
        'stripe_id'
    ];

    public function courses()
    {
        return $this->hasMany(OrderCourse::class);
    }
}
