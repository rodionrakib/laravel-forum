<?php

namespace Tests\Feature;

use App\Reply;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class FavouriteTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function must_be_sign_in_to_favouite_anything()
    {
        $reply = create(Reply::class);

        $this->post('replies/'.$reply->id.'/favourites')
                ->assertRedirect('/login');
    }

    /** @test */
    public function an_authenticated_user_can_favourite_any_reply()
    {
        $this->signIn();

        $this->withoutExceptionHandling();

        $reply = create(Reply::class);

        $this->post('replies/'.$reply->id.'/favourites');

        $this->assertDatabaseHas('favourites',['favorited_id' => $reply->id,'favorited_type'=> Reply::class ]);

        $this->assertCount(1,$reply->favourites);
    }

    /** @test */
    public function an_authenticated_user_can_not_favouite_a_reply_many_times()
    {
        $this->signIn();

        $this->withoutExceptionHandling();

        $reply = create(Reply::class);

        $this->post('replies/'.$reply->id.'/favourites');
        $this->post('replies/'.$reply->id.'/favourites');


        $this->assertCount(1,$reply->favourites);


    }
}
