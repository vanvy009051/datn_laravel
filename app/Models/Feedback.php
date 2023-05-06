<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Feedback extends Model
{
    //
    protected $fillable = [
        'fullname', 'user_id', 'email', 'phone_number', 'note', 'status'
    ];
    protected $table = 'feedback';
    protected $primarykey = 'id';
    protected $guarded = [];

    public function user(): HasOne
    {
        return $this->hasOne(User::class, 'user_id', 'id');
    }
}
