<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Inventory extends Model
{
    //
    protected $fillable = [
        'product_id', 'supplier_id', 'quantity'
    ];
    protected $table = 'inventory';
    protected $primarykey = 'id';
    protected $guarded = [];

    public function product(): HasOne
    {
        return $this->hasOne(Product::class, 'product_id', 'id');
    }

    public function suppliers(): HasOne
    {
        return $this->hasOne(Suppliers::class, 'supplier_id', 'id');
    }
}
