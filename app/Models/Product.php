<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Product extends Model
{
    protected $fillable = [
        'category_id', 'brand_id', 'title', 'price', 'product_cost', 'thumbnail', 'product_description', 'product_status', 'product_slug', 'coupon_id'
    ];
    protected $table = 'products';
    protected $primaryKey = 'product_id';
    protected $guarded = [];

    public function product()
    {
        return $this->hasMany('App\Models\Comments');
    }

    public function category()
    {
        return $this->belongsTo('App\Models\Category', 'category_id');
    }

    public function brand()
    {
        return $this->belongsTo('App\Models\Brand', 'brand_id');
    }

    // public function order_details(): HasMany
    // {
    //     return $this->hasMany(Order_Details::class, 'product_id');
    // }

    // public function category(): HasOne
    // {
    //     return $this->hasOne(Category::class, 'category_id');
    // }

    // public function brand(): HasOne
    // {
    //     return $this->hasOne(Brand::class, 'brand_id');
    // }

    // public function inventory(): HasMany
    // {
    //     return $this->hasMany(Inventory::class, 'product_id');
    // }

    // public function coupon(): HasOne
    // {
    //     return $this->hasOne(Coupon::class, 'product_id');
    // }

    // public function favor_product(): HasMany
    // {
    //     return $this->hasMany(Favor_Product::class, 'product_id');
    // }
}
