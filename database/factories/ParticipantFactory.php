<?php

namespace Database\Factories;

use App\Models\Department;
use App\Models\Participant;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class ParticipantFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Participant::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $gender = $this->faker->randomElement(['male', 'female']);
        $departmentIds = Department::all()->pluck('id')->toArray();
        return [
            'first_name' => $this->faker->firstName($gender),
            'last_name' => $this->faker->lastName,
            'email_address' => $this->faker->email,
            'phone_number' => $this->faker->phoneNumber,
            'department_id' => $this->faker->randomElement($departmentIds),
        ];
    }
}
