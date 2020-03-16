<?php

namespace Tests\Feature\Events;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

use App\Event;
use App\User;
use App\Tag;

use Illuminate\Database\Eloquent\ModelNotFoundException;

class CreateEvent extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function testCreateSimpleEvent()
    {
        $name = "Test Event";
        $description = "Test Description";
        $startDate = \Carbon\Carbon::now();

        $createdEvent = new Event();
        $createdEvent->name = $name;
        $createdEvent->description = $description;
        $createdEvent->start_date = $startDate;
        $createdEvent->save();

        // Test model has correct data
        $testedEvent = Event::find($createdEvent->id);
        $this->assertEquals($testedEvent->name, $name);
        $this->assertEquals($testedEvent->description, $description);
        $this->assertEquals($testedEvent->start_date, $startDate);

        $testedEvent->delete();
    }

    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function testCreateCreatorLinkedEvent()
    {
        $name = "Test Event";
        $description = "Test Description";
        $startDate = \Carbon\Carbon::now();
        $user = factory(User::class)->create();

        $createdEvent = new Event();
        $createdEvent->name = $name;
        $createdEvent->description = $description;
        $createdEvent->start_date = $startDate;
        $createdEvent->creator_id = $user->id;
        $createdEvent->save();

        // Test model has correct data
        $testedEvent = Event::find($createdEvent->id);
        $this->assertEquals($testedEvent->name, $name);
        $this->assertEquals($testedEvent->description, $description);
        $this->assertEquals($testedEvent->start_date, $startDate);
        $this->assertEquals($testedEvent->creator_id, $user->id);
        $this->assertTrue($user->created_events()->contains($testedEvent->id));

        $testedEvent->delete();
    }



    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function testCreateTaggedEvent()
    {
        $name = "Test Event";
        $description = "Test Description";
        $startDate = \Carbon\Carbon::now();
        $user = factory(User::class)->create();
        $tags = ["test", "event", "created in test"];

        $createdEvent = new Event();
        $createdEvent->name = $name;
        $createdEvent->description = $description;
        $createdEvent->start_date = $startDate;
        $createdEvent->creator_id = $user->id;
        $createdEvent->save();

        foreach ($tags as $tag) {
            $tagModel = Tag::firstOrCreate(['name' => $tag]);
            $createdEvent->tags()->attach($tagModel);
        }

        // Test model has correct data
        $testedEvent = Event::find($createdEvent->id);
        $this->assertEquals($testedEvent->name, $name);
        $this->assertEquals($testedEvent->description, $description);
        $this->assertEquals($testedEvent->start_date, $startDate);
        $this->assertEquals($testedEvent->creator_id, $user->id);
        $this->assertTrue($user->created_events()->contains($testedEvent->id));

        $this->assertTrue(count($testedEvent->tags) == count($tags));

        foreach ($testedEvent->tags as $tag) {
            $this->assertTrue(in_array($tag->name,$tags));
        }

        $testedEvent->delete();
    }

    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function testCreateLocationEvent()
    {
        $name = "Test Event";
        $description = "Test Description";
        $startDate = \Carbon\Carbon::now();
        $user = factory(User::class)->create();
        $tags = ["test", "event", "created in test"];
        $lat = -53;
        $lng = 1;

        $createdEvent = new Event();
        $createdEvent->name = $name;
        $createdEvent->description = $description;
        $createdEvent->start_date = $startDate;
        $createdEvent->creator_id = $user->id;
        $createdEvent->latitude = $lat;
        $createdEvent->longitude = $lng;

        $createdEvent->save();

        foreach ($tags as $tag) {
            $tagModel = Tag::firstOrCreate(['name' => $tag]);
            $createdEvent->tags()->attach($tagModel);
        }

        // Test model has correct data
        $testedEvent = Event::find($createdEvent->id);
        $this->assertEquals($testedEvent->name, $name);
        $this->assertEquals($testedEvent->description, $description);
        $this->assertEquals($testedEvent->start_date, $startDate);
        $this->assertEquals($testedEvent->creator_id, $user->id);
        $this->assertEquals($testedEvent->latitude, $lat);
        $this->assertEquals($testedEvent->longitude, $lng);
        $this->assertTrue($user->created_events()->contains($testedEvent->id));

        $this->assertTrue(count($testedEvent->tags) == count($tags));

        foreach ($testedEvent->tags as $tag) {
            $this->assertTrue(in_array($tag->name,$tags));
        }

        $testedEvent->delete();
    }
}
