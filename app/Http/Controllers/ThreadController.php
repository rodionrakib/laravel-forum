<?php

namespace App\Http\Controllers;

use App\Channel;
use App\Thread;
use App\User;
use Illuminate\Http\Request;

class ThreadController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth')->except(['show','index']);
    }

    /**
     * Display a listing of the resource.
     *
     * @param Channel $channel
     * @param Request $request
     * @return \Illuminate\Http\Response
     */
    public function index(Channel $channel,Request $request)
    {

        if($channel->exists){
            $threads = $channel->threads()->latest();
        }
        else{
            $threads = Thread::latest();
        }

        if($userName = $request->query('by')){
            $user = User::where('name',$userName)->firstOrFail();
            $threads = Thread::where('user_id',$user->id)->latest();
        }
        $threads = $threads->get();

        return view('threads.index',compact('threads'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('threads.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'body' => 'required',
            'channel_id' => 'required|exists:App\Channel,id'
        ]);

        $thread = Thread::create([
           'title' => $request->get('title'),
           'body' => $request->get('body'),
           'user_id' => auth()->id(),
            'channel_id' => $request->get('channel_id')
        ]);

        return redirect($thread->path());
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Thread  $thread
     * @return \Illuminate\Http\Response
     */
    public function show(Channel $channel,Thread $thread)
    {
        return view('threads.show',compact('thread'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Thread  $thread
     * @return \Illuminate\Http\Response
     */
    public function edit(Thread $thread)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Thread  $thread
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Thread $thread)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Thread  $thread
     * @return \Illuminate\Http\Response
     */
    public function destroy(Thread $thread)
    {
        //
    }
}
