<?php

namespace Database\Seeders;

use DB;

use Illuminate\Database\Seeder;

class InventorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //

        DB::table('inventories')->insertOrIgnore([

            [
                'type' => 'Vehicle',
                'image' => 'truck_a.png',
                'name' =>  'Truck A',
                'description' => 'Intertrade Truck for transporting goods'

            ],

            [
                'type' => 'Vehicle',
                'image' => 'truck_b.png',
                'name' =>  'Truck B',
                'description' => 'Intertrade Truck for transporting goods'

            ],

            [

                'type' => 'Bus',
                'image' => 'bus_a.png',
                'name' =>  'Bus A',
                'description' => 'Intertrade Bus for transporting goods'

            ],

            [
                
                'type' => 'Pickup',
                'image' => 'tundra.png',
                'name' =>  'Tundra',
                'description' => 'Intertrade Pickup for transporting goods'

            ],


        ]);


    }
}
