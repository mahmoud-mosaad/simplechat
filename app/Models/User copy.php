<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Backpack\CRUD\app\Models\Traits\CrudTrait;
use Spatie\Permission\Traits\HasRoles;
// use Glorand\Model\Settings\Traits\HasSettingsField;

class User extends Authenticatable
{
    use Notifiable;
    use CrudTrait;
    use HasRoles;
    // use HasSettingsField;

    public $timestamps = false;

    public $defaultSettings = [
        'responsiveTable' => true,
    ];

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'user_name', 'password', 'type',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token', 'pivot'
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
//        'email_verified_at' => 'datetime',
    ];

    public function user_avatar()
    {
        return asset('assets/img/avatar-bg.png');
    }

    public function threads()
    {
        // ->withTimestamps()
        return $this->belongsToMany(\App\Models\Thread::class);
    }

    public function messages()
    {
        return $this->hasMany(\App\Models\Message::class, 'author_id', 'id');
    }

    public function notes()
    {
        return $this->hasMany(\App\Models\Note::class, 'author_id', 'id');
    }

}
