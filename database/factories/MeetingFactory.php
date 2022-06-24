<?php

namespace Database\Factories;

use App\Models\User;
use App\Models\Meeting;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Meeting>
 */
class MeetingFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'meeting_id'  => Meeting::factory(),
            'user_id'     => User::factory(),
            'cousreTitle' => $this->faker->word(),
            'ended'       => $this->faker->boolean(),
        ];
    }
}
