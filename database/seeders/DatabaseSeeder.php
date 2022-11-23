<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'login' => 'admin',
            'full_name' => 'Admin Admin Admin',
            'password' => Hash::make('123456'),
            'country' => 'USA',
            'city' => 'London',
            'hobby' => 'Gaming',
            'birthday' => Carbon::now()
        ]);
        \App\Models\User::factory(50)->create();

    }
}
