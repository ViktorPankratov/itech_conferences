<?php

namespace Database\Factories;

use App\Models\Conference;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class ConferenceFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Conference::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $start_date = '2020-' . $this->faker->unique()->date('m-d', '+3 months');
        return [
            'name' => 'Конференция ' . $start_date,
            'location' => $this->faker->streetAddress,
            'start_time' => $start_date . ' 18:00'
        ];
    }
}
