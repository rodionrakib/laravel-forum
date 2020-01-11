<?php
namespace App;

trait RecordActivity{
    protected function recordActivity($eventType)
    {
        if(auth()->guest()){ return; }
        $this->activities()->create([
            'event_type' => $this->getEventType($eventType),
            'user_id'=>auth()->id()
        ]);

    }

    protected function getEventType($eventType)
    {
        return strtolower( (new \ReflectionClass($this))->getShortName()).'_'.$eventType;
    }
}
