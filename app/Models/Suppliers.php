<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Suppliers extends Model
{
    //
    protected $fillable = [
        'id', 'name', 'email', 'address', 'phone_number'
    ];
    protected $table = 'suppliers';
    protected $primarykey = 'id';
    protected $guarded = [];

    public function inventory(): HasOne
    {
        return $this->hasOne(Inventory::class, 'supplier_id', 'id');
    }
}
