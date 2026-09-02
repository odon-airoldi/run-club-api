<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;

use Database\Factories\UserFactory;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Attributes\Hidden;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

#[Fillable(['first_name', 'last_name', 'email', 'picture', 'password'])]
#[Hidden(['password', 'remember_token'])]
class User extends Authenticatable
{
    /** @use HasFactory<UserFactory> */
    use HasFactory, Notifiable;

    /**
     * Get the attributes that should be cast.
     *
     * @return array <string, string>
     */

    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    // accessor - trasformo picture in lettura dal model, senza modificare il valore del db
    protected function picture(): Attribute
    {
        return Attribute::make(
            // get è una funzione eseguita quando accedi a $user->picture che riceve come valore grezzo quello del db
            // funzioen con parametro value, se value ha un valore trasformalo altrimenti null
            get: fn($value) => $value ? asset('storage/' . $value) : null,
        );
    }

    public function workouts()
    {
        return $this->hasMany(Workout::class);
    }

    public function runsWorkouts()
    {
        return $this->belongsToMany(Workout::class);
    }
}
