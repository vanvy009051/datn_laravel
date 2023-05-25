<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Cities extends Model
{
    protected $fillable = [
        'city_name', 'city_type'
    ];
    protected $table = 'tbl_tinhthanhpho';
    protected $primaryKey = 'matp';
    protected $guarded = [];
}
