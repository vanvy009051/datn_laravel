<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
// use Illuminate\Database\Eloquent\Relations\HasMany;

class Category extends Model
{
    //
    protected $fillable = [
        'category_name', 'status', 'category_slug', 'description', 'created_at', 'updated_at'
    ];
    protected $table = 'categories';
    protected $primaryKey = 'category_id';
    protected $guarded = [];

    public function product()
    {
        return $this->hasMany('App\Models\Product', 'category_id');
    }
}
