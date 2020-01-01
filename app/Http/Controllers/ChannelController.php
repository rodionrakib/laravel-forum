<?php

namespace App\Http\Controllers;

use App\Channel;
use App\Thread;
use Illuminate\Http\Request;

class ChannelController extends Controller
{
    public function index(Channel $channel)
    {
        $threads = $channel->threads;
        return view('channels.index',compact('threads'));

    }
}
