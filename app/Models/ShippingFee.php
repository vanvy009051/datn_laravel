<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ShippingFee extends Model
{
    public $timestamps = false;
    protected $fillable = [
        'fee_matp', 'fee_maqh', 'fee_xaid', 'fee_price'
    ];
    protected $table = 'shipping_fee';
    protected $primaryKey = 'fee_id';
    protected $guarded = [];

    public function city()
    {
        return $this->belongsTo('App\Models\Cities', 'fee_matp', 'matp');
    }

    public function province()
    {
        return $this->belongsTo('App\Models\Provinces', 'fee_maqh', 'maqh');
    }

    public function town()
    {
        return $this->belongsTo('App\Models\Towns', 'fee_xaid', 'xaid');
    }
}
