<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Project;
use App\Models\MediaBank;
use Illuminate\Http\Request;
use App\Mail\ProjectUpdateMail;
use App\Models\ProjectReport;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;

class ProjectController extends Controller
{
    //

    public function update_project_admin(Request $request)
    {
        # code...

        // return Carbon::today()->format('d');


        $latest_update = DB::table('media_banks')
        // ->join('users', 'media_banks.user_id', '=', 'users.id')
        ->whereDay('created_at', Carbon::today()->format('d'))
        ->where('admin_notified', 0)->get();



        $latest_update = MediaBank::with('uploadedBy')->whereIn('id', $latest_update->pluck(['id']))->get();

        // return $latest_update;

        if ($latest_update->count() > 0) {
            # code...


        $data = [





        ];
            Mail::to('victor@intertradeltd.biz')->send(new ProjectUpdateMail($data));



        }



    }

    public function project_reports(Request $request)
    {
        # code...




        $reports = ProjectReport::where('project_id', $request->project_id)->get();

        $delivered_count = ProjectReport::where('project_id', $request->project_id)->where('delivery_status', 'delivered')->get()->count();

        $installation_count = ProjectReport::where('project_id', $request->project_id)->where('installation_status', 'installed')->get()->count();



        return [
            'reports' => $reports,
            'delivered_count' => $delivered_count,
            'installation_count' => $installation_count
        ];
    }

    public function update_report_line(Request $request)
    {
        # code...

        $reportLine = ProjectReport::find($request->id);



        if ($request->report_type == 'delivery') {
            # code...

            if ($reportLine->delivery_status == 'not delivered') {
                # code...

                $projectReport = ProjectReport::find($request->id)->update([
                    'delivery_status' => 'delivered'
                ]);

                return $projectReport;
            }else{

                $projectReport = ProjectReport::find($request->id)->update([
                    'delivery_status' => 'not delivered'
                ]);

                return $projectReport;

            }



        }else{

            if ($reportLine->delivery_status == 'not delivered') {
                # code...

                $projectReport = ProjectReport::find($request->id)->update([
                    'installation_status' => 'installed'
                ]);

                return $projectReport;
            }else{

                $projectReport = ProjectReport::find($request->id)->update([
                    'installation_status' => 'not installed'
                ]);

                return $projectReport;

            }

        }

    }
}
