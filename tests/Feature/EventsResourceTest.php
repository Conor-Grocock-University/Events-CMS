<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

use \App\User;

class EventsResourceTest extends TestCase
{
    public function testIndex()
    {
        $response = $this->get(route('events.index'));

        $response->assertStatus(200);
    }

    public function testCreate()
    {
        $user = factory(User::class)->create();

        // Test unauthorised create
        $this->get(route('events.create'))
             ->assertStatus(302);

        // Test authorised create
        $this->actingAs($user)
             ->get(route('events.create'))
             ->assertStatus(200);
    }
}
