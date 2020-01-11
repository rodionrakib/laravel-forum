<?php

namespace Tests\Unit;

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

        $this->assertEquals(2,$thread->activities()->count());
    }


    /** @test */
    public function it_records_a_activity_when_reply_is_created()
    {
        $this->withoutExceptionHandling();

        $this->signIn();

        $reply = create(Reply::class);

        $this->assertDatabaseHas('activities',[
            'user_id' => auth()->id(),
            'event_type' => 'reply_created',
            'subject_id' => $reply->id,
            'subject_type' => Reply::class,
        ]);

        $this->assertEquals(1,$reply->activities()->count());
    }


}
