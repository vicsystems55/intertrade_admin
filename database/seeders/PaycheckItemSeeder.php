<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PaycheckItemSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //

        DB::table('paycheck_items')->insertOrIgnore([

            [
                'name' => 'House Allowance',
                'desc' => 'House Allowance',
                'amount' => 0,
                'per_gross' => 0.43,
                'per_basic' => 0,
            ],

            [
                'name' => 'Transport Allowance',
                'desc' => 'Transport Allowance',
                'amount' => 0,
                'per_gross' => 0.21,
                'per_basic' => 0,
            ],


        ]);
    }
}
