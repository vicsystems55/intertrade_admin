<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

use DB;

class AccountHeadSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //

        DB::table('account_heads')->insertOrIgnore([

            [

                'title' => 'Administrative Expense',
                'description' => 'Administrative Expense'

            ],

            [

                'title' => 'Operations',
                'description' => 'Operations expenditure'

            ],


        ]);
    }
}
