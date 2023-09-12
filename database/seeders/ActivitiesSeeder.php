<?php

namespace Database\Seeders;

use App\Models\Activities\Activity;
use Illuminate\Database\Seeder;
use Illuminate\Support\Carbon;
class ActivitiesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Activity::create([
            // 'ar'                    => [
            //     'name'              => 'ويب سايت',
            //     'locale'            => 'ar',
            //     'activity_id'       => 1,
            //     'created_at'        => Carbon::now(),
            //     'updated_at'        => Carbon::now(),
            // ],
            'en'                    => [
                'name'              => 'website',
                'locale'            => 'en',
                'activity_id'       => 1,
                'created_at'        => Carbon::now(),
                'updated_at'        => Carbon::now(),
            ],
            'is_active'             => 1,
            'created_at'            => Carbon::now(),
            'updated_at'            => Carbon::now(),
        ]);
        Activity::create([
            // 'ar'                    => [
            //     'name'              => 'سوشيال ميديا',
            //     'locale'            => 'ar',
            //     'activity_id'       => 2,
            //     'created_at'        => Carbon::now(),
            //     'updated_at'        => Carbon::now(),
            // ],
            'en'                    => [
                'name'              => 'social media',
                'locale'            => 'en',
                'activity_id'       => 2,
                'created_at'        => Carbon::now(),
                'updated_at'        => Carbon::now(),
            ],
            'is_active'             => 1,
            'created_at'            => Carbon::now(),
            'updated_at'            => Carbon::now(),
        ]);
    }
}
