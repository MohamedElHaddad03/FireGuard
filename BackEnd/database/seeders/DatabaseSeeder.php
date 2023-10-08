<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
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
        \App\Models\User::factory(10)->create();
        \App\Models\chats::factory(20)->create();
        \App\Models\media::factory(20)->create();
        \App\Models\reports::factory(20)->create();
        \App\Models\location::factory(20)->create();
        \App\Models\statistics::factory(20)->create();
        \App\Models\comments::factory(20)->create();
    }
}
