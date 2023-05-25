<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Statisticals extends Model
{
    public $timestamps = false;
    protected $fillable = [
        'order_date', 'sales', 'profit', 'quantity', 'total_order'
    ];
    protected $table = 'statisticals';
    protected $primaryKey = 'id_statistical';
    protected $guarded = [];
}
