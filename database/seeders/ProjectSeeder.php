<?php

namespace Database\Seeders;

use Carbon\Carbon;



use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProjectSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //

        DB::table('projects')->insertOrIgnore([

            [
                'project_code' => 'ITLP2021000',
                'title' => 'UNICEF UCC-ODP-COVID SUPPORT',
                'description' => 'UNICEF UCC-ODP-COVID SUPPORT- 10 August 2021',
                'project_type' => 'Deliveries',
                'start_date' => '10 August 2021',
                'end_date' => '10 September 2021',
            ],


        ]);
    }
}

