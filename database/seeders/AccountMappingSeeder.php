<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

use DB;

class AccountMappingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //'

        DB::table('account_mappings')->insert([

            [
                'account_heads_id' => '1',
               

            ],

           

       
        ]);
    }
}
