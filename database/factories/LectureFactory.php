<?php

namespace Database\Factories;

use App\Models\Conference;
use App\Models\Lecture;
use App\Models\Participant;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class LectureFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Lecture::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $participantIds = Participant::all()->pluck('id')->toArray();
        $conferenceIds = Conference::all()->pluck('id')->toArray();
        return [
            'title' => 'Тестовый заголовок',
            'description' => $this->faker->realText,
            'participant_id' => $this->faker->randomElement($participantIds),
            'conference_id' => $this->faker->randomElement($conferenceIds),
        ];
    }
}
