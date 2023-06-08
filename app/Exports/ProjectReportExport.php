<?php

namespace App\Exports;

use App\Models\ProjectReport;
use Maatwebsite\Excel\Concerns\FromCollection;

class ProjectReportExport implements FromCollection
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return ProjectReport::all();
    }
}
