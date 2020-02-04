<?php

namespace Tests\Unit;

use App\Reply;
use App\Thread;
use App\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ReplyTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function it_has_a_creator()
    {
        $creator = create(User::class);
        $reply = create(Reply::class,['user_id'=>$creator->id]);
        $this->assertEquals($creator->name,$reply->creator->name);
    }

    /** @test */
    public function it_require_a_body()
    {
        $this->signIn();

        $thread = create(Thread::class);

        $this->post($thread->path().'/replies',raw(Reply::class,['body'=>null]))
            ->assertSessionHasErrors('body');

    }


    /** @test */
    public function guest_user_cant_delete_any_reply()
    {
        // when guest he cant deleted
        $reply = create(Reply::class);

        $this->delete('/replies/'.$reply->id);

        $this->assertDatabaseHas('replies',['body'=>$reply->body]);


        // logged in user can only delete his reply
    }

    /** @test */
    public function un_authorized_user_cant_delete_any_reply()
    {
        $this->signIn();

        $reply = create(Reply::class);

        $this->delete('/replies/'.$reply->id);

        $this->assertDatabaseHas('replies',['body'=>$reply->body]);

    }

    /** @test */
    public function authorized_user_can_delete_reply()
    {
        $this->withoutExceptionHandling();
        $this->signIn();
        $reply = create(Reply::class,['user_id'=>auth()->id()]);
        $this->delete('/replies/'.$reply->id);
        $this->assertDatabaseMissing('replies',['body'=>$reply->body]);
    }

    /** @test */
    public function only_authorized_user_can_update_reply()
    {
        $this->withoutExceptionHandling();
        $this->signIn();
        $reply = create(Reply::class,['user_id'=>auth()->id()]);
        $this->patch('/replies/'.$reply->id,[
            'body' => 'updated reply'
        ]);
        $this->assertDatabaseHas('replies',['body'=>'updated reply']);
    }

    /** @test */
    public function un_authorized_user_cannot_update_reply()
    {
//        $this->withoutExceptionHandling();

        $reply = create(Reply::class);

        $this->signIn();

        $this->patch('/replies/'.$reply->id,[
            'body' => 'updated reply'
        ]);
        $this->assertDatabaseHas('replies',['body'=>$reply->body]);
    }
}
