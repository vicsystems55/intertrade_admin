<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\LoadAuditGeneration;
use Illuminate\Support\Facades\Auth;

class LoadAuditGenerationController extends Controller
{
    //

    public function generateAudit(Request $request)
    {

        $request->validate([
            'selectedRegion' => 'required|string',
            'backupTime' => 'required|integer|min:6',
            'selectedPanelSize' => 'required|string',
            'selectedInverterType' => 'required|string',
            'totalLoadConsumption' => 'required|numeric',
            'totalPower' => 'required|numeric',
            'loadEntries' => 'required|array',
            'loadEntries.*.equipment_name' => 'required|string',
            'loadEntries.*.quantity' => 'required|integer|min:1',
            'loadEntries.*.max_power' => 'required|numeric',
            'loadEntries.*.day_hours_usage' => 'required|integer',
            'loadEntries.*.night_hours_usage' => 'required|integer'
        ]);


        // Create Technician Request
        $technicianRequest = LoadAuditGeneration::create([
            'user_id' => Auth::id(),
            'selectedRegion' => $request->selected_region,
            'backupTime' => $request->preferred_backup_time,
            'selectedPanelSize' => $request->solar_panel_size,
            'selectedInverterType' => $request->inverter_type,
            'totalPower' => $request->total_max_power,
            'totalLoadConsumption' => $request->total_load_consumption
        ]);


        return $request->all();
    }
}
