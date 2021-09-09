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

        DB::table('account_mappings')->insertOrIgnore([

            [
                'account_heads_id' => 1,
                'account_sub_head_id ' => 1,

            ],

        ]);
    }
}
