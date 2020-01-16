<?php

namespace App;

use App\Filter\ThreadFilter;
use App\Scopes\ThreadScope;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

class Thread extends Model
{
    use RecordActivity;

    protected $guarded=[];

//    protected $withCount=['replies'];

    public static function boot()
    {
        parent::boot();
        static::addGlobalScope(new ThreadScope());

        static::deleting(function($thread){
            $thread->replies()->delete();
            $thread->activities()->delete();
        });

        foreach (static::getRecordedEvents() as $event){
            static::$event(function($thread) use ($event){
                $thread->recordActivity($event);

            });
        }


    }

    protected static function getRecordedEvents()
    {
        return ['created','updated'];
    }

    public function replies()
    {
        return $this->hasMany(Reply::class)->with('creator');
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

    public function scopeFilter(Builder $query, ThreadFilter $filters)
    {
        $filters->apply($query);
    }

    public function activities()
    {
        return $this->morphMany(Activity::class,'subject');
    }




}
