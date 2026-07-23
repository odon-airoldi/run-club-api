<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Workout extends Model
{
    protected $casts = [
        'date_time' => 'datetime',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function runUsers()
    {
        return $this->belongsToMany(User::class);
    }

    // campi del modello autorizzati in scrittura
    protected $fillable = [
        'name',
        'description',
        'date_time',
        'place_city',
        'place_address',
        'buffer_time',
        'distance',
        'pace',
        'user_id'
    ];
}
