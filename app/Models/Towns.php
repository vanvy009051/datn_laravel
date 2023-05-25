<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Towns extends Model
{
    protected $fillable = [
        'town_name', 'town_type', 'maqh'
    ];
    protected $table = 'tbl_xaphuongthitran';
    protected $primaryKey = 'xaid';
    protected $guarded = [];

    public function province()
    {
        return $this->belongsTo('App\Models\Provinces', 'maqh');
    }
}
