<?php

namespace Database\Seeders;

use App\Models\SalaryStructure;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SalaryStructureSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //

        $structures = [

            [
                'designation' => 'MD 1',
                'description' => 'Managing Director 1',
                'gross' => '500000',
            ],

            [
                'designation' => 'MD 2',
                'description' => 'Managing Director 2',
                'gross' => '270000',
            ],

            [
                'designation' => 'Project Manager',
                'description' => 'Project Manager',
                'gross' => '265000',
            ],

            [
                'designation' => 'Accountant',
                'description' => 'Accountant',
                'gross' => '195000',
            ],


            [
                'designation' => 'IT Officer',
                'description' => 'IT Officer',
                'gross' => '195000',
            ],

            [
                'designation' => 'Tecnician 1',
                'description' => 'Techician 1',
                'gross' => '115000',
            ],

            [
                'designation' => 'Tecnician 2',
                'description' => 'Techician 2',
                'gross' => '105000',
            ],

            [
                'designation' => 'Head Tecnician',
                'description' => 'Head Techician',
                'gross' => '125000',
            ],


            [
                'designation' => 'Head Driver',
                'description' => 'Head Driver',
                'gross' => '100000',
            ],

            [
                'designation' => 'MD-PA',
                'description' => 'MD-PA',
                'gross' => '140000',
            ],

            [
                'designation' => 'Technical Engineer',
                'description' => 'Technical Engineer',
                'gross' => '135000',
            ],

            [
                'designation' => 'Receptionist',
                'description' => 'Receptionist',
                'gross' => '105000',
            ],




        ];

        foreach ($structures as $structure) {
            SalaryStructure::updateOrCreate(
                ['designation' => $structure['designation']],
                $structure
            );
        }

        $salStructures = SalaryStructure::get();

        foreach ($salStructures as $key => $salStructure) {
            # code...

            $salStructure->update([
                'basic' => $salStructure->gross * 0.43
            ]);
        }
    }



}
