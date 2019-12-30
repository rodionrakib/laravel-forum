<?php

namespace Tests\Feature;

use App\Reply;
use App\Thread;
use App\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ThreadTest extends TestCase
{
    use RefreshDatabase;

    public $thread;

    protected function setUp(): void
    {
        parent::setUp();
        $this->thread = create(Thread::class);
    }

    /** @test */
    public function authorize_user_can_create_a_thread()
    {
        $this->withoutExceptionHandling();

        $this->signIn();

        $data = raw(Thread::class);

        $response = $this->post('/threads',$data);

        $this->get($response->headers->get('Location'))->assertSee($data['title']);

    }

    /** @test */
    public function un_authorize_user_can_not_create_a_thread()
    {
        $this->withoutExceptionHandling();
        $this->expectException('Illuminate\Auth\AuthenticationException');
        $data = raw(Thread::class);
        $this->post('/threads',$data);
    }


    /** @test */
    public function un_authorize_user_can_not_see_create_thread_page()
    {
        $this->get('/threads/create')->assertRedirect('/login');

    }


    /** @test */
    public function authenticated_user_can_add_a_reply_to_a_thread()
    {
        $this->withoutExceptionHandling();

        $this->signIn();

        $replyData = raw(Reply::class);

        $this->post($this->thread->path().'/replies',$replyData);

        $this->assertDatabaseHas('replies',['body'=>$replyData['body']]);

        $this->get($this->thread->path())->assertSee($replyData['body']);

    }

    /** @test */
    public function un_authenticated_user_can_not_add_a_reply_to_a_thread()
    {
        $this->withoutExceptionHandling();

        $this->expectException('Illuminate\Auth\AuthenticationException');
        $this->post($this->thread->path().'/replies',raw(Reply::class));


    }
}
