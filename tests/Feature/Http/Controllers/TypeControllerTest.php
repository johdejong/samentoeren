<?php

namespace Tests\Feature\Http\Controllers;

use App\Models\Type;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use JMac\Testing\Traits\AdditionalAssertions;
use Tests\TestCase;

/**
 * @see \App\Http\Controllers\TypeController
 */
class TypeControllerTest extends TestCase
{
    use AdditionalAssertions, RefreshDatabase, WithFaker;

    /**
     * @test
     */
    public function index_displays_view()
    {
        $types = Type::factory()->count(3)->create();

        $response = $this->get(route('type.index'));

        $response->assertOk();
        $response->assertViewIs('type.index');
        $response->assertViewHas('types');
    }


    /**
     * @test
     */
    public function create_displays_view()
    {
        $response = $this->get(route('type.create'));

        $response->assertOk();
        $response->assertViewIs('type.create');
    }


    /**
     * @test
     */
    public function store_uses_form_request_validation()
    {
        $this->assertActionUsesFormRequest(
            \App\Http\Controllers\TypeController::class,
            'store',
            \App\Http\Requests\TypeStoreRequest::class
        );
    }

    /**
     * @test
     */
    public function store_saves_and_redirects()
    {
        $type = $this->faker->word;

        $response = $this->post(route('type.store'), [
            'type' => $type,
        ]);

        $types = Type::query()
            ->where('type', $type)
            ->get();
        $this->assertCount(1, $types);
        $type = $types->first();

        $response->assertRedirect(route('type.index'));
        $response->assertSessionHas('type.id', $type->id);
    }


    /**
     * @test
     */
    public function show_displays_view()
    {
        $type = Type::factory()->create();

        $response = $this->get(route('type.show', $type));

        $response->assertOk();
        $response->assertViewIs('type.show');
        $response->assertViewHas('type');
    }


    /**
     * @test
     */
    public function edit_displays_view()
    {
        $type = Type::factory()->create();

        $response = $this->get(route('type.edit', $type));

        $response->assertOk();
        $response->assertViewIs('type.edit');
        $response->assertViewHas('type');
    }


    /**
     * @test
     */
    public function update_uses_form_request_validation()
    {
        $this->assertActionUsesFormRequest(
            \App\Http\Controllers\TypeController::class,
            'update',
            \App\Http\Requests\TypeUpdateRequest::class
        );
    }

    /**
     * @test
     */
    public function update_redirects()
    {
        $type = Type::factory()->create();
        $type = $this->faker->word;

        $response = $this->put(route('type.update', $type), [
            'type' => $type,
        ]);

        $type->refresh();

        $response->assertRedirect(route('type.index'));
        $response->assertSessionHas('type.id', $type->id);

        $this->assertEquals($type, $type->type);
    }


    /**
     * @test
     */
    public function destroy_deletes_and_redirects()
    {
        $type = Type::factory()->create();

        $response = $this->delete(route('type.destroy', $type));

        $response->assertRedirect(route('type.index'));

        $this->assertSoftDeleted($type);
    }
}
