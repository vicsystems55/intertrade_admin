<?php

namespace Database\Seeders;

use App\Models\Deduction;
use Illuminate\Database\Seeder;

class DeductionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $deductionData = [

            [
                'name' => 'EMPLOYEE PENSION CONTRIBUTIONS',
                'desc' => 'EMPLOYEE PENSION CONTRIBUTIONS',
                'amount' => 0,
                'per_deduct' => 0.08,
                'status' => 'active'
            ],

        ];

        // Create the deductions
        Deduction::insert($deductionData);
    }
}
