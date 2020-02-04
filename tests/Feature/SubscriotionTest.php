<?php

namespace Tests\Feature;

use App\Thread;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class SubscriotionTest extends TestCase
{
    use RefreshDatabase;
    /** @test */
    public function it_can_be_subscribed()
    {
        $this->withoutExceptionHandling();
        $thread = create(Thread::class);
        $this->signIn();
        $this->post($thread->path().'/subscriptions');

        $this->assertCount(1,$thread->subscribers);
    }
}
