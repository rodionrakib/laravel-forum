<?php

namespace App\Http\Controllers;

use App\Channel;
use App\Filter\ThreadFilter;
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
     * @param ThreadFilter $filters
     * @param Channel $channel
     * @param Request $request
     * @return \Illuminate\Http\Response
     */
    public function index(Channel $channel,ThreadFilter $filters)
    {

        $threads = $this->getThreads($channel,$filters);

        if(\request()->wantsJson()){
            return $threads;
        }

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
        return view('threads.show',[
            'thread' => $thread,
            'replies' => $thread->replies()->paginate(5)
        ]);
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
    public function update(Request $request,Channel $channel, Thread $thread)
    {
        $this->authorize('manage',$thread);
        $thread->fill($request->all());
        $thread->save();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Thread  $thread
     * @param  \App\Channel  $channel
     * @return \Illuminate\Http\Response
     */
    public function destroy(Channel $channel,Thread $thread)
    {
//        abort_unless($thread->user_id == auth()->id(),403);
        $this->authorize('delete',$thread);
        $thread->delete();
        return redirect('/threads');
    }

    /**
     * @param Channel $channel
     * @param Request $request
     * @return \Illuminate\Database\Eloquent\Collection|\Illuminate\Database\Eloquent\Relations\HasMany
     */
    protected function getThreads(Channel $channel,$filters)
    {
        $threads = Thread::with(['channel','owner'])->latest()->filter($filters);


        if ($channel->exists) {
            $threads->where('channel_id',$channel->id);
        }

        return $threads->get();
    }
}
