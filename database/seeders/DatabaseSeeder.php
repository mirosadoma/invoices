<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Database\Seeders\AdminsSeeder;
use Database\Seeders\CountriesSeeder;
use Database\Seeders\UsersSeeder;
use Database\Seeders\SettingsSeeder;
use Database\Seeders\RolesSeeder;
use Database\Seeders\ActivitiesSeeder;
use Database\Seeders\ProjectsSeeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call([
            // AdminsSeeder::class,
            // CountriesSeeder::class,
            // UsersSeeder::class,
            // SettingsSeeder::class,
            // RolesSeeder::class,
            // ActivitiesSeeder::class,
            // ProjectsSeeder::class,
        ]);
    }
}
