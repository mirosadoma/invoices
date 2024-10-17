<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Carbon;

class UsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Client
        User::create([
            'name'                  => 'Ahmed Alshazly',
            'email'                 => 'shazly@gmail.com',
            'phone'                 => '01272020202',
            // 'password'              => \Hash::make('123456'),
            'is_active'             => 1,
            'country_id'            => 1,
            'type'                  => 'client',
            'created_at'            => Carbon::now(),
            'updated_at'            => Carbon::now(),
        ]);
        // Freelancer
        User::create([
            'name'                  => 'Amr Mohamed',
            'email'                 => 'amrmohamed171996@gmail.com',
            'phone'                 => '01276069689',
            // 'password'              => \Hash::make('123456'),
            'is_active'             => 1,
            'country_id'            => 1,
            'type'                  => 'freelancer',
            'created_at'            => Carbon::now(),
            'updated_at'            => Carbon::now(),
        ]);
    }
}
