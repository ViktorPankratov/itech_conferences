<?php

namespace Database\Seeders;

use App\Models\Conference;
use App\Models\Department;
use App\Models\Lecture;
use App\Models\Participant;
use Database\Factories\ParticipantFactory;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // User::factory(10)->create();
        Conference::factory(10)->create();
        Participant::factory(30)->create();
        Lecture::factory(300)->create();
    }
}
