<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Provinces extends Model
{
    protected $fillable = [
        'province_name', 'province_type', 'matp'
    ];
    protected $table = 'tbl_quanhuyen';
    protected $primaryKey = 'maqh';
    protected $guarded = [];

    public function city()
    {
        return $this->belongsTo('App\Models\Cities', 'matp');
    }
}
