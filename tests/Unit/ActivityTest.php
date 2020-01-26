<?php

namespace Tests\Unit;

use App\Activity;
use App\Reply;
use App\Thread;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ActivityTest extends TestCase
{
    use RefreshDatabase;
    /** @test */
    public function it_records_a_activity_when_thread_is_created()
    {
        $this->withoutExceptionHandling();

        $this->signIn();

        $thread = create(Thread::class);

        $this->assertDatabaseHas('activities',[
            'user_id' => auth()->id(),
            'event_type' => 'thread_created',
            'subject_id' => $thread->id,
            'subject_type' => Thread::class,
        ]);

        $this->assertEquals(1,$thread->activities()->count());
    }


    /** @test */
    public function it_records_a_activity_when_thread_is_updated()
    {
        $this->withoutExceptionHandling();

        $this->signIn();

        $thread = create(Thread::class);

        $thread->title = 'New Title';
        $thread->save();

        $this->assertDatabaseHas('activities',[
            'subject_id'=>$thread->id,
            'subject_type'=>get_class($thread),
            'event_type' => 'thread_updated'
        ]);

    }


    /** @test */
    public function it_records_a_activity_when_reply_is_created()
    {
        $this->withoutExceptionHandling();

        $this->signIn();

        $reply = create(Reply::class);


        $this->assertEquals(2,Activity::count());
    }

    /** @test */
    public function when_thread_is_deleted_all_activity_belongs_to_the_threads_Are_also_deleted()
    {
        $this->signIn();
        $thread =create(Thread::class,['user_id'=>auth()->id()]);
        $thread->delete();
        $this->assertDatabaseMissing('activities',[
            'subject_id'=>$thread->id,
            'subject_type'=>get_class($thread),
            ]);

    }


}
