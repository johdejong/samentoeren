<?php

namespace Tests\Feature\Http\Controllers;

use App\Models\Ride;
use Carbon\Carbon;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use JMac\Testing\Traits\AdditionalAssertions;
use Tests\TestCase;

/**
 * @see \App\Http\Controllers\RideController
 */
class RideControllerTest extends TestCase
{
    use AdditionalAssertions, RefreshDatabase, WithFaker;

    /**
     * @test
     */
    public function index_displays_view()
    {
        $rides = Ride::factory()->count(3)->create();

        $response = $this->get(route('ride.index'));

        $response->assertOk();
        $response->assertViewIs('ride.index');
        $response->assertViewHas('rides');
    }


    /**
     * @test
     */
    public function create_displays_view()
    {
        $response = $this->get(route('ride.create'));

        $response->assertOk();
        $response->assertViewIs('ride.create');
    }


    /**
     * @test
     */
    public function store_uses_form_request_validation()
    {
        $this->assertActionUsesFormRequest(
            \App\Http\Controllers\RideController::class,
            'store',
            \App\Http\Requests\RideStoreRequest::class
        );
    }

    /**
     * @test
     */
    public function store_saves_and_redirects()
    {
        $name = $this->faker->name;
        $description = $this->faker->text;
        $type_id = $this->faker->randomNumber();
        $status_id = $this->faker->randomNumber();
        $start_date = $this->faker->date();
        $start_time = $this->faker->time();
        $start_place = $this->faker->word;
        $distance = $this->faker->randomNumber();

        $response = $this->post(route('ride.store'), [
            'name' => $name,
            'description' => $description,
            'type_id' => $type_id,
            'status_id' => $status_id,
            'start_date' => $start_date,
            'start_time' => $start_time,
            'start_place' => $start_place,
            'distance' => $distance,
        ]);

        $rides = Ride::query()
            ->where('name', $name)
            ->where('description', $description)
            ->where('type_id', $type_id)
            ->where('status_id', $status_id)
            ->where('start_date', $start_date)
            ->where('start_time', $start_time)
            ->where('start_place', $start_place)
            ->where('distance', $distance)
            ->get();
        $this->assertCount(1, $rides);
        $ride = $rides->first();

        $response->assertRedirect(route('ride.index'));
        $response->assertSessionHas('ride.id', $ride->id);
    }


    /**
     * @test
     */
    public function show_displays_view()
    {
        $ride = Ride::factory()->create();

        $response = $this->get(route('ride.show', $ride));

        $response->assertOk();
        $response->assertViewIs('ride.show');
        $response->assertViewHas('ride');
    }


    /**
     * @test
     */
    public function edit_displays_view()
    {
        $ride = Ride::factory()->create();

        $response = $this->get(route('ride.edit', $ride));

        $response->assertOk();
        $response->assertViewIs('ride.edit');
        $response->assertViewHas('ride');
    }


    /**
     * @test
     */
    public function update_uses_form_request_validation()
    {
        $this->assertActionUsesFormRequest(
            \App\Http\Controllers\RideController::class,
            'update',
            \App\Http\Requests\RideUpdateRequest::class
        );
    }

    /**
     * @test
     */
    public function update_redirects()
    {
        $ride = Ride::factory()->create();
        $name = $this->faker->name;
        $description = $this->faker->text;
        $type_id = $this->faker->randomNumber();
        $status_id = $this->faker->randomNumber();
        $start_date = $this->faker->date();
        $start_time = $this->faker->time();
        $start_place = $this->faker->word;
        $distance = $this->faker->randomNumber();

        $response = $this->put(route('ride.update', $ride), [
            'name' => $name,
            'description' => $description,
            'type_id' => $type_id,
            'status_id' => $status_id,
            'start_date' => $start_date,
            'start_time' => $start_time,
            'start_place' => $start_place,
            'distance' => $distance,
        ]);

        $ride->refresh();

        $response->assertRedirect(route('ride.index'));
        $response->assertSessionHas('ride.id', $ride->id);

        $this->assertEquals($name, $ride->name);
        $this->assertEquals($description, $ride->description);
        $this->assertEquals($type_id, $ride->type_id);
        $this->assertEquals($status_id, $ride->status_id);
        $this->assertEquals(Carbon::parse($start_date), $ride->start_date);
        $this->assertEquals($start_time, $ride->start_time);
        $this->assertEquals($start_place, $ride->start_place);
        $this->assertEquals($distance, $ride->distance);
    }


    /**
     * @test
     */
    public function destroy_deletes_and_redirects()
    {
        $ride = Ride::factory()->create();

        $response = $this->delete(route('ride.destroy', $ride));

        $response->assertRedirect(route('ride.index'));

        $this->assertSoftDeleted($ride);
    }
}
