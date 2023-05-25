<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Comments extends Model
{
    protected $fillable = [
        'comment_product_id', 'comment_text', 'comment_user_name', 'created_at'
    ];
    protected $table = 'comments';
    protected $primaryKey = 'comment_id';
    protected $guarded = [];

    public function product()
    {
        return $this->belongsTo('App\Models\Product', 'comment_product_id');
    }
}
