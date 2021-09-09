<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

use DB;

class AccountSubHeadSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //

        DB::table('account_sub_heads')->insertOrIgnore([

            [

                'title' => 'Fuel',
                'description' => 'Fuel',

            ],

            [

                'title' => 'Repair',
                'description' => 'Repair of any equipment',

            ],

            [

                'title' => 'Purchase',
                'description' => 'Stock purchase',

            ],

            [

                'title' => 'Security',
                'description' => 'All expense about security',

            ],

            [

                'title' => 'Sanitation',
                'description' => 'Cleaning services',

            ],

            [

                'title' => 'Training',
                'description' => 'Educational resources',

            ],

            [

                'title' => 'Construction',
                'description' => 'Building of structures',

            ],

        ]);
    }
}
