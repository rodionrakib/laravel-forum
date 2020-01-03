<?php

namespace Tests\Feature;

use App\Channel;
use App\Reply;
use App\Thread;
use App\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class BrowsThreadTest extends TestCase
{
    use RefreshDatabase;

    public $thread;

    protected function setUp(): void
    {
        parent::setUp();
        $this->thread = create(Thread::class);
    }


    /** @test */
    public function anyone_can_brows_threads()
    {
        $this->withoutExceptionHandling();

        // when anyone visit threads page
        $this->get('/threads')->assertSee($this->thread->title);
        // they can view all the threads

    }


    /** @test */
    public function anyone_can_brows_single_thread()
    {
        $this->withoutExceptionHandling();

        // when anyone visit threads page
        $this->get($this->thread->path())->assertSee($this->thread->title);
        // they can view all the threads
    }

    /** @test */
    public function anyone_can_see_replies_associated_with_that_thread()
    {
        $this->withoutExceptionHandling();

        $reply = create(Reply::class,['thread_id'=>$this->thread->id]);

        // when anyone visit single thread page
        $this->get($this->thread->path())->assertSee($reply->body);
        // they can view all the replies to that thread
    }

    /** @test */
    public function user_can_filter_threads_by_channel()
    {
        $this->withoutExceptionHandling();

        $channel = create(Channel::class);

        $threadInChannel = create(Thread::class,['channel_id'=>$channel->id]);
        $threadNotInChannel = create(Thread::class);

        $this->get('threads/'.$channel->slug)
            ->assertSee($threadInChannel->title)
            ->assertDontSee($threadNotInChannel);
    }

    /** @test */
    public function user_can_filter_thread_by_name()
    {
        // give we have two thread one by john and one not by jon
        $jon = create(User::class,['name'=>'jon']);

        $threadByJon = create(Thread::class,['user_id'=>$jon->id]);
        $threadNotByJon = create(Thread::class);

        // when he visit threads?by=jon
        $this->get('threads?by=jon')
            ->assertSee($threadByJon->title)
            ->assertDontSee($threadNotByJon->title);
        // he should see his thread but not other
    }






}
