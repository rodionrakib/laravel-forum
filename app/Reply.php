<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Reply extends Model
{
    protected $guarded=[];

    public function creator()
    {
        return $this->belongsTo(User::class,'user_id');
    }

    public function favourites()
    {
         return $this->morphMany(Favourite::class,'favorited');
    }

    public function favourite()
    {
        $this->favourites()->create(['user_id'=>auth()->id()]);
    }

    public function isAlreadyFavorated()
    {
        return $this->favourites()->where('user_id',auth()->id())->exists();
    }

    //
}
