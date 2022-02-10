<?php

namespace Database\Factories;

use App\Models\Ride;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class RideFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Ride::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => $this->faker->name,
            'description' => $this->faker->text,
            'type_id' => $this->faker->randomNumber(),
            'status_id' => $this->faker->randomNumber(),
            'start_date' => $this->faker->date(),
            'start_time' => $this->faker->time(),
            'start_place' => $this->faker->regexify('[A-Za-z0-9]{255}'),
            'finish_date' => $this->faker->date(),
            'finish_time' => $this->faker->time(),
            'finish_place' => $this->faker->regexify('[A-Za-z0-9]{255}'),
            'distance' => $this->faker->randomNumber(),
        ];
    }
}
