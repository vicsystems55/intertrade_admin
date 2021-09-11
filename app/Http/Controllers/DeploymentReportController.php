<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\DeploymentReport;

use Auth;

class DeploymentReportController extends Controller
{
    //

    public function create_report()
    {

        
            $request->validate([
                // 'date_submitted' => 'required|unique:deployment_reports',
                // 'amount' => 'required|numeric|min:99700|between:0,99.99',
                // 'number_of_accounts' => 'required|numeric|min:1|max:15',
                // 'file' => 'required|image|mimes:jpg,png,jpeg,gif,svg|max:2048',
                
            ]);

        $report_code = Session::get('report_code');
        
        $report = DeploymentReport::where('report_code', $report_code)->update([
            'reporter_id' => Auth::user()->id,
            'state' => $request->state,
            'site_name' => $request->site_name,
            'model' => $request->model,
            'installation_completion_date' => $request->installation_completion_date,
            'ucc_serial_number' => $request->ucc_serial_number,
            'rtmd_number' => $request->rtmd_number,
            'functional_state' => $request->functional_state,
            'temp_at_update' => $request->temp_at_update,
            'date_submitted' => $request->date_submitted,
            'remark' => $request->remark,
            'status' => 'submitted'
        ]);

        return back()->with('report_msg', 'Report Submitted');


    }
}
