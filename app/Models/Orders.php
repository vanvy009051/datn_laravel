<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Orders extends Model
{
    //
    protected $fillable = [
        'user_id', 'fullname', 'email', 'phone_number', 'address', 'note', 'order_date'
    ];
    protected $table = 'orders';
    protected $primarykey = 'order_id';
    protected $guarded = [];

    public function order_details(): HasMany {
        return $this->hasMany(Order_Details::class, 'order_id', 'id');
    }

    public function user(): HasOne {
        return $this->hasOne(User::class, 'user_id', 'id');
    }
}
