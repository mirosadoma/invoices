<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Carbon;
use App\Models\Countries\Country;

class CountriesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Country::create([
            // 'ar'                    => [
            //     'name'              => 'مصر',
            //     'locale'            => 'ar',
            //     'country_id'        => 1,
            //     'created_at'        => Carbon::now(),
            //     'updated_at'        => Carbon::now(),
            // ],
            'en'                    => [
                'name'              => 'Egypt',
                'locale'            => 'en',
                'country_id'        => 1,
                'created_at'        => Carbon::now(),
                'updated_at'        => Carbon::now(),
            ],
            'is_active'             => 1,
            'created_at'            => Carbon::now(),
            'updated_at'            => Carbon::now(),
        ]);
    }
}
