<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\HasMany;
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
        'fullname', 'email', 'password', 'address', 'role_id'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password'
    ];

    protected $table = 'users';
    protected $primarykey = 'id';
    protected $guarded = [];

    // public function role(): HasOne
    // {
    //     return $this->hasOne(Role::class, 'role_id', 'id');
    // }

    // public function orders(): HasMany
    // {
    //     return $this->hasMany(Order::class, 'order_id', 'id');
    // }

    // public function favor_products(): HasMany
    // {
    //     return $this->hasMany(Favor_Product::class, 'user_id', 'id');
    // }

    // public function feedback(): HasMany
    // {
    //     return $this->hasMany(Feedback::class, 'user_id', 'id');
    // }
}
