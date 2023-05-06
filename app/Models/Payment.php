<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Payment extends Model
{
    protected $fillable = [
        'payment_method', 'payment_status'
    ];
    protected $table = 'payments';
    protected $primarykey = 'payment_id';
    protected $guarded = [];

    public function product(): HasMany
    {
        return $this->hasMany(Order::class, 'payment_id');
    }
}
