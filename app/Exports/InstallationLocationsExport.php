<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class InstallationLocationsExport implements FromCollection, WithHeadings
{
    protected $locations;

    public function __construct($locations)
    {
        $this->locations = $locations;
    }

    public function collection()
    {
        return $this->locations->map(function ($location) {
            return [
                'project_name' => $location->project_name,
                'location_name' => $location->location_name,
                'latitude' => $location->latitude,
                'longitude' => $location->longitude,
                'project_type' => $location->project_type,
                'description' => $location->description,
                'state' => $location->state,
                'local_government' => $location->local_government,
                'installation_date' => $location->installation_date,
            ];
        });
    }

    public function headings(): array
    {
        return [
            'Project Name',
            'Location Name',
            'Latitude',
            'Longitude',
            'Project Type',
            'Description',
            'State',
            'Local Government',
            'Installation Date'
        ];
    }
}
