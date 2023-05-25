<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Role extends Model
{
    //
    protected $fillable = [
        'id', 'name'
    ];
    protected $table = 'roles';
    protected $primaryKey = 'id';
    protected $guarded = [];

    public function user(): HasMany
    {
        return $this->hasMany(User::class, 'role_id', 'id');
    }
}
