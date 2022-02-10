<?php

namespace Database\Factories;

use App\Models\Route;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class RouteFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Route::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => $this->faker->name(),
            'originalName' => $this->faker->regexify('[A-Za-z0-9]{255}'),
            'size' => $this->faker->randomNumber(),
            'extension' => $this->faker->regexify('[A-Za-z0-9]{8}'),
            'path' => $this->faker->regexify('[A-Za-z0-9]{255}'),
            'lastModified' => $this->faker->dateTime(),
        ];
    }
}
