<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'surename', 'email', 'city', 'address', 'phone', 'password'
    ];

    /**
     * The attributes that should be hidden for arrays
.     *
     * @var array
     */
protected $hidden = [
    'password', 'remember_token',
];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
    
    public function role() {
        return $this->belongsToMany(Role::class, 'user_roles');
    }

    public function isAdministrator() {
        return $this->role()->where('name', 'admin')->exists();
    }

    public function isUser() {
       return $this->role()->where('name', 'user')->exists();
    }

    public function isDisabled() {
        return $this->role()->where('name', 'disabled')->exists();
    }

}
