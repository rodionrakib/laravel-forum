<?php

namespace Tests\Unit;


use App\Channel;
use App\Thread;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ChannelTest extends \Tests\TestCase
{
    use RefreshDatabase;

    /** @test */
  public function it_has_many_threads()
  {
      $channel = create(Channel::class);
      create(Thread::class,['channel_id'=>$channel->id]);
      create(Thread::class,['channel_id'=>$channel->id]);

      $this->assertCount(2,$channel->threads);
  }
}
