<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Orders extends Model
{
    //
    protected $fillable = [
        'user_id', 'shipping_id', 'order_status', 'order_code', 'order_date', 'created_at', 'updated_at'
    ];
    protected $table = 'orders';
    protected $primaryKey = 'order_id';
    protected $guarded = [];
}
