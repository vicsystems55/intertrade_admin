<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\MediaBank;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PageController extends Controller
{
    //

    public function project_reports(Request $request)
    {
        # code...



        $media_assets = MediaBank::where('project_id', $request->id)->get();

        $days_reports = [];

        $month_no =  Carbon::now()->format('m');

        $daysInMonth = Carbon::now()->month($month_no)->daysInMonth;

        for ($i=0; $i < $daysInMonth; $i++) {
            # code...
            $day_report = DB::table('media_banks')
            ->where('project_id', $request->id)
            ->whereDay('created_at', $i)->get();
            array_push($days_reports, $day_report);

        }

        // $days_reports = array_reverse($days_reports);



        // return $days_reports;

        // return $media_assets;


        return view('project_reports', compact('media_assets', 'days_reports'));
    }

    public function projects(Request $request)
    {
        # code...




        return view('projects');
    }
}
