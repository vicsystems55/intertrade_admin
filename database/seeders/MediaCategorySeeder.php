<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class MediaCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //

        DB::table('media_categories')->insertOrIgnore([

            [
                "name" => "Solar Installation",
                "status"=> "active",
                "banner_img" => asset('file_category_banner').'/solar.png'
            ],

            [
                "name" => "Cold Chain Installation",
                "status"=> "active",
                "banner_img" => asset('file_category_banner').'/cold_chain.png'
            ],

            [
                "name" => "Uncategorized",
                "status"=> "active",
                "banner_img" => asset('file_category_banner').'/uncategorized.png'
            ],


             ]);

    }
}
