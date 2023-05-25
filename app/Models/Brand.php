<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Brand extends Model
{
    protected $fillable = [
        'brand_name', 'brand_slug', 'status', 'description', 'created_at', 'updated_at'
    ];
    protected $table = 'brands';
    protected $primaryKey = 'brand_id';
    protected $guarded = [];

    public function product()
    {
        return $this->hasMany('App\Models\Product', 'brand_id');
    }
}
