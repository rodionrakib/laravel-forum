<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Thread extends Model
{
    protected $guarded=[];

    public function replies()
    {
        return $this->hasMany(Reply::class);
    }

    public function path()
    {
        return '/threads/'.$this->channel->slug.'/'.$this->id;
    }
    public function owner()
    {
        return $this->belongsTo(User::class,'user_id');
    }
    public function channel()
    {
        return $this->belongsTo(Channel::class);
    }
}
