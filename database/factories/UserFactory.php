<?php

namespace Database\Factories;

use App\Models\User;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class UserFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = User::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $gender = $this->faker->randomElement(['male', 'female']);

        return [
            'name' => $this->faker->name(),
            'email' => $this->faker->unique()->safeEmail(),
            'username' => $this->faker->unique()->userName,
            'age' => random_int(18,65),
            'gender' => $gender,
            'phone' => $this->faker->phoneNumber,
            'address' => $this->faker->address,
            'profession' => ["artist", "teacher"][random_int(0,1)],
            'active' => random_int(0,1),
            'role' => "user",
            'email_verified_at' => now(),
            'password' => Hash::make("pass"),
            'remember_token' => Str::random(10),
            "email_verified_at" => Carbon::now(),
            "email_verification_token" => null
        ];
    }

    /**
     * Indicate that the model's email address should be unverified.
     *
     * @return \Illuminate\Database\Eloquent\Factories\Factory
     */
    public function unverified()
    {
        return $this->state(function (array $attributes) {
            return [
                'email_verified_at' => null,
            ];
        });
    }
}
