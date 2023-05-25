<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Suppliers extends Model
{
    //
    protected $fillable = [
        'name', 'email', 'address', 'phone_number'
    ];
    protected $table = 'suppliers';
    protected $primaryKey = 'supplier_id';
    protected $guarded = [];
}
