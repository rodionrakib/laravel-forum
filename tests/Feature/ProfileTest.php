<?php

namespace Tests\Feature;

use App\Thread;
use App\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ProfileTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function user_have_a_profile_page()
    {
        $this->withoutExceptionHandling();
        $user = create(User::class);
        $this->get('/profiles/'.$user->name)->assertSee($user->name);
    }

    /** @test */
    public function profile_page_shows_his_all_posted_threads()
    {
        $this->withoutExceptionHandling();

        $this->signIn();

        $thread =create(Thread::class,['user_id'=>auth()->id()]);
        $this->get('/profiles/'.auth()->user()->name)->assertSee($thread->title);
    }
}
