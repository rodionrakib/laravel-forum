<?php

namespace Tests\Unit;

use App\Reply;
use App\Thread;
use App\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ThreadTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function it_has_many_replies()
    {
        $thread = create('App\Thread');

        $reply = create(Reply::class,['thread_id'=>$thread->id]);

        $this->assertCount(1,$thread->replies);

    }

    /** @test */
    public function it_has_a_owner()
    {
        $owner = create(User::class);
        $thread = create(Thread::class,['user_id'=>$owner->id]);
        $this->assertEquals($owner->name,$thread->owner->name);
    }

    /** @test */
    public function it_belongs_to_a_channel()
    {
        $thread = create(Thread::class);
        $this->assertInstanceOf('App\Channel', $thread->channel);
    }

    /** @test */
    public function it_knows_its_path()
    {
       $thread =  create(Thread::class);
       $this->assertEquals('/threads/'.$thread->channel->slug.'/'.$thread->id ,$thread->path());
    }
}
