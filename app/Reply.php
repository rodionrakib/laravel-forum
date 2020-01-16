<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Reply extends Model
{
    use RecordActivity;

    protected $guarded=[];

    protected $withCount=['favourites'];

    protected static function boot()
    {
        parent::boot();

        foreach (static::getRecordedEvents() as $event){
            static::$event(function($reply) use ($event){
                $reply->recordActivity($event);

            });
        }
    }

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

    public function activities()
    {
        return $this->morphMany(Activity::class,'subject');
    }

    protected static function getRecordedEvents()
    {
        return ['created'];
    }

    public function thread()
    {
        return $this->belongsTo(Thread::class);
    }

    //
}
