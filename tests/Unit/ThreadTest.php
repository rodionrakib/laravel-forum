<?php

namespace Tests\Unit;

use App\Channel;
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

    /** @test */
    public function it_require_a_title()
    {
        $this->signIn();
        $this->publishThread(['title'=> null])
            ->assertSessionHasErrors('title');
    }

    /** @test */
    public function it_require_a_body()
    {
        $this->signIn();
        $this->publishThread(['body'=> null])
            ->assertSessionHasErrors('body');
    }

    /** @test */
    public function it_require_a_existing_channel_id()
    {
        $this->signIn();

        factory(Channel::class,3)->create();

        $this->publishThread(['channel_id'=> null])
            ->assertSessionHasErrors('channel_id');

        $this->publishThread(['channel_id'=> 1000])
            ->assertSessionHasErrors('channel_id');
    }

    private function publishThread($data)
    {
        $thread = make(Thread::class,$data);
        return $this->post('/threads',$thread->toArray());

    }
}
