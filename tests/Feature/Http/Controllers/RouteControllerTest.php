<?php

namespace Tests\Feature\Http\Controllers;

use App\Models\Route;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use JMac\Testing\Traits\AdditionalAssertions;
use Tests\TestCase;

/**
 * @see \App\Http\Controllers\RouteController
 */
class RouteControllerTest extends TestCase
{
    use AdditionalAssertions, RefreshDatabase, WithFaker;

    /**
     * @test
     */
    public function index_displays_view()
    {
        $routes = Route::factory()->count(3)->create();

        $response = $this->get(route('route.index'));

        $response->assertOk();
        $response->assertViewIs('route.index');
        $response->assertViewHas('routes');
    }


    /**
     * @test
     */
    public function create_displays_view()
    {
        $response = $this->get(route('route.create'));

        $response->assertOk();
        $response->assertViewIs('route.create');
    }


    /**
     * @test
     */
    public function store_uses_form_request_validation()
    {
        $this->assertActionUsesFormRequest(
            \App\Http\Controllers\RouteController::class,
            'store',
            \App\Http\Requests\RouteStoreRequest::class
        );
    }

    /**
     * @test
     */
    public function store_saves_and_redirects()
    {
        $name = $this->faker->name;
        $originalName = $this->faker->word;
        $size = $this->faker->randomNumber();
        $extension = $this->faker->word;
        $path = $this->faker->word;
        $lastModified = $this->faker->dateTime();

        $response = $this->post(route('route.store'), [
            'name' => $name,
            'originalName' => $originalName,
            'size' => $size,
            'extension' => $extension,
            'path' => $path,
            'lastModified' => $lastModified,
        ]);

        $routes = Route::query()
            ->where('name', $name)
            ->where('originalName', $originalName)
            ->where('size', $size)
            ->where('extension', $extension)
            ->where('path', $path)
            ->where('lastModified', $lastModified)
            ->get();
        $this->assertCount(1, $routes);
        $route = $routes->first();

        $response->assertRedirect(route('route.index'));
        $response->assertSessionHas('route.id', $route->id);
    }


    /**
     * @test
     */
    public function show_displays_view()
    {
        $route = Route::factory()->create();

        $response = $this->get(route('route.show', $route));

        $response->assertOk();
        $response->assertViewIs('route.show');
        $response->assertViewHas('route');
    }


    /**
     * @test
     */
    public function edit_displays_view()
    {
        $route = Route::factory()->create();

        $response = $this->get(route('route.edit', $route));

        $response->assertOk();
        $response->assertViewIs('route.edit');
        $response->assertViewHas('route');
    }


    /**
     * @test
     */
    public function update_uses_form_request_validation()
    {
        $this->assertActionUsesFormRequest(
            \App\Http\Controllers\RouteController::class,
            'update',
            \App\Http\Requests\RouteUpdateRequest::class
        );
    }

    /**
     * @test
     */
    public function update_redirects()
    {
        $route = Route::factory()->create();
        $name = $this->faker->name;
        $originalName = $this->faker->word;
        $size = $this->faker->randomNumber();
        $extension = $this->faker->word;
        $path = $this->faker->word;
        $lastModified = $this->faker->dateTime();

        $response = $this->put(route('route.update', $route), [
            'name' => $name,
            'originalName' => $originalName,
            'size' => $size,
            'extension' => $extension,
            'path' => $path,
            'lastModified' => $lastModified,
        ]);

        $route->refresh();

        $response->assertRedirect(route('route.index'));
        $response->assertSessionHas('route.id', $route->id);

        $this->assertEquals($name, $route->name);
        $this->assertEquals($originalName, $route->originalName);
        $this->assertEquals($size, $route->size);
        $this->assertEquals($extension, $route->extension);
        $this->assertEquals($path, $route->path);
        $this->assertEquals($lastModified, $route->lastModified);
    }


    /**
     * @test
     */
    public function destroy_deletes_and_redirects()
    {
        $route = Route::factory()->create();

        $response = $this->delete(route('route.destroy', $route));

        $response->assertRedirect(route('route.index'));

        $this->assertSoftDeleted($route);
    }
}
