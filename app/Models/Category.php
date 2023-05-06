<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Category extends Model
{
    //
    protected $fillable = [
        'name', 'status'
    ];
    protected $table = 'categories';
    protected $primarykey = 'id';
    protected $guarded = [];

    public function product(): HasMany
    {
        return $this->hasMany(Product::class, 'category_id', 'id');
    }
}
