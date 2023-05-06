<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Socials extends Model
{
    protected $fillable = [
        'provider_user_id', 'provider', 'user_id'
    ];
    protected $table = 'socials';
    protected $primarykey = 'user_social_id';
    protected $guarded = [];

    public function users()
    {
        $this->belongsTo('App\User', 'user_id');
    }
}
