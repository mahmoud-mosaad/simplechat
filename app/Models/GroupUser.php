<?php

namespace App\Models;

// use Illuminate\Database\Eloquent\Model;
use Jenssegers\Mongodb\Eloquent\Model;

class GroupUser extends Model
{
    protected $fillable = ['group_id', 'user_id'];

    public function userInfo()
    {
        return $this->hasOne('App\Models\User', 'id');
    }
}
