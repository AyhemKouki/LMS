<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Room extends Model
{
    protected $fillable = [
        'name',
        'course_id',
        'user_id',

    ];

    public function course()
    {
        return $this->belongsTo(Course::class);
    }

    /**
     * Relation avec l'instructeur
     */
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function messages()
    {
        return $this->hasMany(Message::class);
    }
}
