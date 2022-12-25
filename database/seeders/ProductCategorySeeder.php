<?php

namespace Database\Seeders;

use App\Models\ProductCategory;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProductCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        DB::table('product_categories')->insertOrIgnore([
            [
                'name' => 'Inverters',
                'featured_image' => config('app.url').'product_category/inverters.png'
            ],

            [
                'name' => 'Panels',
                'featured_image' => config('app.url').'product_category/panels.png'
            ],

            [
                'name' => 'Temperature Monitoring Devices',
                'featured_image' => config('app.url').'product_category/tmds.png'
            ],

            [
                'name' => 'Freezers',
                'featured_image' => config('app.url').'product_category/freezers.png'
            ],

            [
                'name' => 'ULT Freezers',
                'featured_image' => config('app.url').'product_category/ult_freezers.png'
            ],

            [
                'name' => 'Safety Boxes',
                'featured_image' => config('app.url').'product_category/safety_boxes.png'
            ],
        ]);

    }
}
