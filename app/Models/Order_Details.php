<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Order_Details extends Model
{
    //
    protected $fillable = [
        'order_id', 'product_id', 'num', 'price', 'total'
    ];
    protected $table = 'order_details';
    protected $primarykey = 'id';
    protected $guarded = [];

    public function product(): HasOne
    {
        return $this->hasOne(Product::class, 'product_id', 'id');
    }
}
