<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use App\Models\Rental;
class User extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $fillable = [
        'name',
        'email',
        'password',
        'role',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    // Check if user is Admin
    public function isAdmin(): bool
    {
        return $this->role === 'admin';
    }

    // Check if user is Customer
    public function isCustomer(): bool
    {
        return $this->role === 'customer';
    }

    // A user can have multiple rentals
    public function rentals()
    {
        return $this->hasMany(Rental::class);
    }
}
