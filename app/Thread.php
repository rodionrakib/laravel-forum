<?php

namespace App;

use App\Filter\ThreadFilter;
use App\Scopes\ThreadScope;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

class Thread extends Model
{
    protected $guarded=[];

//    protected $withCount=['replies'];

    public static function boot()
    {
        parent::boot();
        static::addGlobalScope(new ThreadScope());
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
}
