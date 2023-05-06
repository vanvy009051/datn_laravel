<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Brand extends Model
{
    protected $fillable = [
        'brand_name', 'status', 'description'
    ];
    protected $table = 'brands';
    protected $primarykey = 'brand_id';
    protected $guarded = [];

    public function product(): HasMany
    {
        return $this->hasMany(Product::class, 'brand_id');
    }
}
