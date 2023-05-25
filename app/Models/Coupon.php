<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Coupon extends Model
{
    //
    protected $fillable = [
        'coupon_name', 'coupon_num', 'coupon_code', 'coupon_condition', 'coupon_percent'
    ];
    protected $table = 'coupons';
    protected $primaryKey = 'coupon_id';
    protected $guarded = [];

    // public function product(): HasMany
    // {
    //     return $this->hasMany(Product::class, 'coupon_id');
    // }
}
