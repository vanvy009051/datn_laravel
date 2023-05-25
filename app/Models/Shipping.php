<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Shipping extends Model
{
    protected $fillable = [
        'shipping_name', 'shipping_address', 'shipping_phone', 'shipping_email', 'shipping_notes', 'shipping_pm_method'
    ];
    protected $table = 'shippings';
    protected $primaryKey = 'shipping_id';
    protected $guarded = [];
}
