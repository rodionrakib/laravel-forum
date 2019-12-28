<?php

namespace Tests\Unit;

use App\Reply;
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
}
