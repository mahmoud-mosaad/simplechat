<?php

namespace App\Models;

// use Illuminate\Database\Eloquent\Model;
use Jenssegers\Mongodb\Eloquent\Model;

class Group extends Model
{
    protected $fillable = ['group_name', 'description'];


    public function users()
    {
        return $this->hasOne('App\Models\GroupUser');
    }

    public function groupUsers()
    {
        return $this->hasMany('App\Models\GroupUser');
    }

}
