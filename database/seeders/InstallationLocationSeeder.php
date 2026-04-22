<?php

namespace Database\Seeders;

use App\Models\InstallationLocation;
use Illuminate\Database\Seeder;

class InstallationLocationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $locations = [
            // Solar Projects
            [
                'project_name' => 'Lekki Solar Farm Phase 1',
                'location_name' => 'Lekki Peninsula',
                'latitude' => 6.4319,
                'longitude' => 3.5296,
                'project_type' => 'solar',
                'description' => 'Large-scale solar farm providing power to residential areas',
                'state' => 'Lagos',
                'local_government' => 'Lekki',
                'installation_date' => '2023-06-15',
                'status' => 'active'
            ],
            [
                'project_name' => 'Abuja Solar Initiative',
                'location_name' => 'Gwagwalada',
                'latitude' => 8.8753,
                'longitude' => 7.0656,
                'project_type' => 'solar',
                'description' => 'Community solar project for FCT',
                'state' => 'FCT',
                'local_government' => 'Gwagwalada',
                'installation_date' => '2023-08-20',
                'status' => 'active'
            ],
            [
                'project_name' => 'Ibadan Solar Complex',
                'location_name' => 'Oyo State',
                'latitude' => 7.3775,
                'longitude' => 3.9470,
                'project_type' => 'solar',
                'description' => 'Industrial solar installation',
                'state' => 'Oyo',
                'local_government' => 'Ibadan',
                'installation_date' => '2023-09-10',
                'status' => 'active'
            ],
            [
                'project_name' => 'Port Harcourt Solar Hub',
                'location_name' => 'Rumuola',
                'latitude' => 4.7711,
                'longitude' => 7.0534,
                'project_type' => 'solar',
                'description' => 'Coastal solar energy facility',
                'state' => 'Rivers',
                'local_government' => 'Port Harcourt',
                'installation_date' => '2023-07-05',
                'status' => 'active'
            ],
            [
                'project_name' => 'Kano Solar Project',
                'location_name' => 'Kano City',
                'latitude' => 12.0022,
                'longitude' => 8.5920,
                'project_type' => 'solar',
                'description' => 'Northern regional solar expansion',
                'state' => 'Kano',
                'local_government' => 'Kano',
                'installation_date' => '2023-10-12',
                'status' => 'active'
            ],

            // Cold Chain Projects
            [
                'project_name' => 'Lagos Cold Storage Facility',
                'location_name' => 'Apapa',
                'latitude' => 6.4136,
                'longitude' => 3.5297,
                'project_type' => 'cold_chain',
                'description' => 'Modern cold chain facility for pharmaceutical storage',
                'state' => 'Lagos',
                'local_government' => 'Apapa',
                'installation_date' => '2023-05-20',
                'status' => 'active'
            ],
            [
                'project_name' => 'Pharmaceutical Distribution Hub - Enugu',
                'location_name' => 'Enugu City',
                'latitude' => 6.4969,
                'longitude' => 7.5519,
                'project_type' => 'cold_chain',
                'description' => 'Regional pharmaceutical cold storage',
                'state' => 'Enugu',
                'local_government' => 'Enugu',
                'installation_date' => '2023-06-08',
                'status' => 'active'
            ],
            [
                'project_name' => 'Vaccine Storage Center - Kaduna',
                'location_name' => 'Kaduna',
                'latitude' => 10.5210,
                'longitude' => 7.4384,
                'project_type' => 'cold_chain',
                'description' => 'Cold chain for vaccine distribution',
                'state' => 'Kaduna',
                'local_government' => 'Kaduna',
                'installation_date' => '2023-07-15',
                'status' => 'active'
            ],
            [
                'project_name' => 'Benin Cold Logistics',
                'location_name' => 'Benin City',
                'latitude' => 6.4969,
                'longitude' => 5.6272,
                'project_type' => 'cold_chain',
                'description' => 'Food and pharmaceutical cold storage',
                'state' => 'Edo',
                'local_government' => 'Benin City',
                'installation_date' => '2023-08-22',
                'status' => 'active'
            ],
            [
                'project_name' => 'Bauchi Medical Cold Chain',
                'location_name' => 'Bauchi',
                'latitude' => 10.3158,
                'longitude' => 9.8437,
                'project_type' => 'cold_chain',
                'description' => 'Regional medical cold storage facility',
                'state' => 'Bauchi',
                'local_government' => 'Bauchi',
                'installation_date' => '2023-09-05',
                'status' => 'active'
            ],
        ];

        foreach ($locations as $location) {
            InstallationLocation::create($location);
        }
    }
}

