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
    public function unauthorized_cant_update_his_thread()
    {
//        $this->withoutExceptionHandling();
        $this->signIn();
        $thread = create(Thread::class);
         $this->patch($thread->path(),[
            'title' => 'Changed',
            'body' => 'new body'
        ]);

        $this->assertDatabaseMissing('threads',['id'=>$thread->id,'title'=>'Changed','body'=>'new body']);

    }

    /** @test */
    public function owner_can_update_his_thread()
    {
        $this->withoutExceptionHandling();
        $this->signIn();
        $thread = create(Thread::class,['user_id'=>auth()->id()]);
        $this->patch($thread->path(),[
            'title' => 'Changed',
            'body' => 'new body'
        ]);
        $this->assertDatabaseHas('threads',['id'=>$thread->id,'title'=>'Changed','body'=>'new body']);

    }
}
