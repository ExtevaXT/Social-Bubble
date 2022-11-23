<?php

namespace Database\Factories;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\User>
 */
class UserFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'login' => fake()->unique()->userName(),
            'full_name' => fake()->name(),
            'password' => Hash::make('123456'),
            'country' => rand(0, 1) ? 'Russia' : 'USA',
            'city' => rand(0, 1) ? 'Moscow' : 'London',
            'hobby' => rand(0, 1) ? 'Music' : 'Gaming',
            'birthday' => Carbon::now()->subYears(rand(1, 100))
        ];
    }

    /**
     * Indicate that the model's email address should be unverified.
     *
     * @return static
     */
    public function unverified()
    {
        return $this->state(fn (array $attributes) => [
            'email_verified_at' => null,
        ]);
    }
}
