<?php

namespace App\Models;

// use Illuminate\Database\Eloquent\Model;
// use Illuminate\Database\Eloquent\SoftDeletes;
use Jenssegers\Mongodb\Eloquent\Model;
use Jenssegers\Mongodb\Eloquent\SoftDeletes;

class Thread extends Model
{
    use SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'description',
        'type'
    ];

    // protected $hidden = ['pivot'];

    public function messages()
    {
        return $this->hasMany(\App\Models\Message::class);
    }

    public function users()
    {
        return $this->belongsToMany(\App\Models\User::class);
    }
}
