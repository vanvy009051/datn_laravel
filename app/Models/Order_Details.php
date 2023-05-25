<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Order_Details extends Model
{
    //
    protected $fillable = [
        'order_id', 'product_id', 'order_code', 'product_name', 'quanlity', 'product_price', 'product_coupon', 'product_feeship'
    ];
    protected $table = 'order__details';
    protected $primarykey = 'order_detail_id';
    protected $guarded = [];

    public function product()
    {
        return $this->belongsTo('App\Models\Product', 'product_id');
    }
}
