<?php

namespace App\Imports;

use App\Models\Product;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class SiteImport implements ToCollection, WithHeadingRow
{
    /**
    * @param Collection $collection
    */
    public function collection(Collection $rows)
    {

        // return $rows;



        foreach ($rows as $row) {
            # code...

            Product::updateOrCreate([
                'id' => $row['id'],
            ],[
            'id' => $row['id'],
            'product_category_id' => $row['product_category_id'],
            'name' => $row['name'],
            'price' => $row['price'],
            'description' => $row['description'],
            'type' => $row['type'],
            'model' => $row['model'],
            'serial_number' => $row['serial_number'],
            'featured_image' => $row['featured_image'],

            ]);


        }

        // return 123;
        // return new Site([
        //     //

        //     'facility_id' => $row['facility_id'],
        //     'contract_id' => $row['contract_id'],
        //     'supervision_team_id' => $row['supervision_team_id'],
        //     'lga_id' => $row['lga'],
        //     'lot_id' => $row['lot_id'],
        //     'percentage_completion' => 0,
        //     'location' => $row['location'],
        //     'ward' => $row['ward']

        // ]);
    }
}
