<?php
namespace App;

trait RecordActivity{

    protected function recordActivity($event)
    {
        if (auth()->guest()) return;
        $this->activities()->create(['user_id' => auth()->id(),'event_type' => $this->getEventType($event)]);

    }

    public function getEventType($event)
    {
        return  strtolower( (new \ReflectionClass($this))->getShortName()."_".$event);
    }

}
