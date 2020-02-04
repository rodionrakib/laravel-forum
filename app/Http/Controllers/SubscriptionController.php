<?php

namespace App\Http\Controllers;

use App\Channel;
use App\Thread;
use Illuminate\Http\Request;

class SubscriptionController extends Controller
{
    public function store(Channel $channel,Thread $thread)
    {
        $thread->subscribe();
    }
}
