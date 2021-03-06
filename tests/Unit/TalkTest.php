<?php

namespace Tests\Unit;

use App\Talk;
use App\User;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class TalkTest extends TestCase
{
    use RefreshDatabase;

    /** @test **/
    public function a_talks_slug_has_its_id_appended()
    {
        $talk = factory(Talk::class)->create(['title' => 'My First Talk']);

        $this->assertEquals('my-first-talk-1', $talk->slug);
    }

    /** @test **/
    public function a_talk_has_a_likes_count_property()
    {
        $users = factory(User::class, 3)->create();
        $talk = factory(Talk::class)->create();

        $users->each->likeTalk($talk);

        $this->assertEquals(3, $talk->likes_count);
    }
}
