<?php

namespace Tests\Feature;

use App\Reply;
use App\Thread;
use App\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ManageThreadTest extends TestCase
{
    use RefreshDatabase;
    /** @test */


    /** @test */
    public function when_a_thread_is_deleted_its_related_replies_are_also_deleted()
    {
        $this->withoutExceptionHandling();
        $owner = create(User::class);
        $this->signIn($owner);

        $thread = create(Thread::class,['user_id'=>$owner->id]);

        create(Reply::class,['thread_id'=>$thread->id],3);
        $this->delete($thread->path());

        $this->assertCount(0,$thread->replies);
    }

    /** @test */
    public function when_a_thread_is_deleted_its_activities_are_also_deleted()
    {
        $this->withoutExceptionHandling();
        $owner = create(User::class);
        $this->signIn($owner);

        $thread = create(Thread::class,['user_id'=>$owner->id]);

        create(Reply::class,['thread_id'=>$thread->id]);

        $this->delete($thread->path());

        $this->assertDatabaseMissing('activities',['subject_id'=>$thread->id,'subject_type',Thread::class]);

    }



    
    /** @test */
    public function unauthorize_user_cannot_delete_threads()
    {


        $thread = create(Thread::class);
        $this->delete($thread->path())->assertRedirect('/login');

        $this->withoutExceptionHandling();

        $user = create(User::class);

        $this->signIn($user);

        $this->expectException('Illuminate\Auth\Access\AuthorizationException');

        $this->delete($thread->path())->assertStatus(403);

    }
}
