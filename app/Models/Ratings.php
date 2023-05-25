<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Ratings extends Model
{
    public $timestamps = false;
    protected $fillable = [
        'product_id', 'rate_star'
    ];
    protected $table = 'ratings';
    protected $primaryKey = 'rating_id';
    protected $guarded = [];
}
