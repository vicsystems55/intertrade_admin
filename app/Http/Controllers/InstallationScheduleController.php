<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\InstallationSchedule;

class InstallationScheduleController extends Controller
{
    //

    public function create_installation_schedule(Request $request)
    {
        # code...

        $request->validate([
            // 'deployment_id' => 'required|unique:truck_routes',
            // 'driver_assigned' => 'required|unique:truck_routes',
            // 'amount' => 'required|numeric|min:99700|between:0,99.99',
            // 'number_of_accounts' => 'required|numeric|min:1|max:15',
            // 'file' => 'required|image|mimes:jpg,png,jpeg,gif,svg|max:2048',
            
        ]);

        // dd($request->all());




        $truck_route = InstallationSchedule::create([

            'deployment_id' => $request->deployment_id,
            'technician_assigned' => $request->technician_assigned

        ]);




        return back()->with('installation_schedule_msg', 'Schedule Created Successfully');
    }
}
