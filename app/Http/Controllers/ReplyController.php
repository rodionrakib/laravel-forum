<?php

namespace App\Http\Controllers;

use App\Channel;
use App\Reply;
use App\Thread;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class ReplyController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param
     */
    public function store(Request $request,Channel $channel,Thread $thread)
    {

        $request->validate([
            'body' => 'required'
        ]);

        $reply =     Reply::create([
            'body' => $request->get('body'),
            'user_id' => auth()->id(),
            'thread_id' => $thread->id
        ]);

        return redirect()->back();
    }

    /**
     * Display the specified resource.
     *
     * @param  Reply  $reply
     */
    public function show(Reply $reply)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Reply  $reply
     * @return \Illuminate\Http\Response
     */
    public function edit(Reply $reply)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Reply  $reply
     * @return  Response
     */
    public function update(Request $request, Reply $reply)
    {
        $this->authorize('update',$reply);
        $reply->update(['body'=>$request->get('body')]);
        return back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Reply  $reply
     * @return \Illuminate\Http\Response
     */
    public function destroy(Reply $reply)
    {
        $this->authorize('delete',$reply);
        // activity also should be deleted and if its favorated by anyone ?
        $reply->delete();
        return back();
    }
}
