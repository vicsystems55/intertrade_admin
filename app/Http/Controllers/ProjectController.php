<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\MediaBank;
use Illuminate\Http\Request;
use App\Mail\ProjectUpdateMail;
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

        return $latest_update;

        if ($latest_update->count() > 0) {
            # code...


        $data = [

            



        ];
            Mail::to('victor@intertradeltd.biz')->send(new ProjectUpdateMail($data));



        }



    }
}
