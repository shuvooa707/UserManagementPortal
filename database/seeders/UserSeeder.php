<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \App\Models\User::insert([
            "name" => "Shuvo  Sarker",
            "username" => "shuvo",
            "email" => "shuvooa707@gmail.com",
            "age" => "25",
            "role" => "admin",
            "profession" => "Engineer",
            "password" => Hash::make("shuvo"),
            "email_verified_at" => Carbon::now(),
            "email_verification_token" => null
        ]);
        \App\Models\User::factory(200)->create();

    }
}
