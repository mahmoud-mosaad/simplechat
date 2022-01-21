<?php

namespace App\Models;

// use Illuminate\Database\Eloquent\Model;
// use Illuminate\Database\Eloquent\SoftDeletes;
use Jenssegers\Mongodb\Eloquent\Model;
use Jenssegers\Mongodb\Eloquent\SoftDeletes;

class Message extends Model
{
    use SoftDeletes;

//    public $incrementing = false;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'author_id',
        'thread_id',
        'text',
        'timestamp',
        'attachments',
        'record',
        'is_read',
    ];

    public function user()
    {
        return $this->belongsTo(\App\Models\User::class, 'author_id');
    }

    public function author()
    {
        return $this->belongsTo(\App\Models\User::class, 'author_id');
    }

    public function thread()
    {
        return $this->belongsTo(\App\Models\Thread::class, 'thread_id');
    }
}
