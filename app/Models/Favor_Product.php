<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Favor_Product extends Model
{
    //
    protected $fillable = [
        'product_id', 'user_id', 'thumbnail', 'product_name', 'price'
    ];
    protected $table = 'favor_products';
    protected $primarykey = 'id';
    protected $guarded = [];

    public function user(): HasOne
    {
        return $this->hasOne(User::class, 'user_id', 'id');
    }

    public function product(): HasOne
    {
        return $this->hasOne(Product::class, 'product_id', 'id');
    }
}
