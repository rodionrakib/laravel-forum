<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Favourite extends Model
{
    use RecordActivity;

    protected $guarded=[];

    protected static function boot()
    {
        parent::boot();
        static::created(function($favourite){
            $favourite->recordActivity('created');

        }) ;
    }

    public function activities()
    {
        return $this->morphMany(Activity::class,'subject');
    }
    public function favorited()
    {
        return $this->morphTo();
    }


}
