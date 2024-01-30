<?php

namespace Database\Seeders;

use App\Models\CustomDeduction;
use App\Models\PaycheckItem;
use App\Models\SalaryStructure;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\SalaryStructureBenefit;

class SalStruBenefitSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //

        $salStructures = SalaryStructure::get();
        $paycheckItems = PaycheckItem::get();

        $payeAmounts = [
            74666.67,
            32526.67,
            28326.67,
            17617.87,
            17617.87,
            7340.00,
            6236.00,
            8444.00,
            5684.00,
            10100.00,
            9548.00,
            6092.00,

        ];



        foreach ($salStructures as $key =>  $salStructure) {

            foreach ($paycheckItems as $item) {

                SalaryStructureBenefit::create([
                    'salary_structure_id' => $salStructure->id,
                    'paycheck_item_id' => $item->id,
                ]);
            }


            CustomDeduction::create([
                'salary_structure_id' => $salStructure->id,
                'name' => 'PAYE',
                'desc' => 'PAYE',
                'amount' => $payeAmounts[$key],
            ]);


        }


    }
}
