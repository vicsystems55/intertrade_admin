<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Deployment;

class DeploymentController extends Controller
{
    //

    public function create_deployment_zone(Request $request)
    {
        # code...

        $request->validate([
            'site_type' => 'required',
            // 'amount' => 'required|numeric|min:99700|between:0,99.99',
            // 'number_of_accounts' => 'required|numeric|min:1|max:15',
            // 'file' => 'required|image|mimes:jpg,png,jpeg,gif,svg|max:2048',
            
        ]);

        $deployment = Deployment::create([
            'site_type' => $request->site_type,
            'state' => $request->state,
            'district' => $request->district,
            'facility_address' => $request->facility_address,
            'facility_name' => $request->facility_name,
            'closet_town' => $request->closet_town,
            'project_OIC' => $request->project_OIC,
            'contact_number' => $request->contact_number,
            'contact_email' => $request->contact_email,
            'no_ucc' => $request->no_ucc,
            'road_access' => $request->road_access,
            'ware_house_distance' => $request->ware_house_distance,
            'road_quality' => $request->road_quality,
            'project_id' => 1,
            'deployment_code' => 'ITL-DEP-'.rand(1000, 909090)
        ]);



        return back()->with('deployment_msg', 'Deployment Site Registered');

    }
}
