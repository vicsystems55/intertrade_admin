<?php
namespace App\Http\Controllers;

use App\Models\LoadAuditGeneration;
use Illuminate\Http\Request;
use App\Models\TechnicianRequest;
use App\Models\LoadEntry;
use Illuminate\Support\Str;

class LoadAuditGenerationController extends Controller
{
public function generateAudit(Request $request)
{
    // Validate incoming request
    $validated = $request->validate([
        'selectedRegion' => 'required|string',
        'selectedPanelSize' => 'required|numeric|min:1',
        'totalPower' => 'required|numeric|min:1',
        'totalLoadConsumption' => 'required|numeric|min:1',
        'selectedInverterType' => 'required|string',
        'loadEntries' => 'required|array',
        'loadEntries.*.name' => 'required|string',
        'loadEntries.*.quantity' => 'required|numeric|min:1',
        'loadEntries.*.power' => 'required|numeric|min:1',
        'loadEntries.*.hoursDay' => 'required|numeric|min:0',
        'loadEntries.*.hoursNight' => 'required|numeric|min:0',
    ]);

    // Define Solar Irradiance per region (Peak Sun Hours)
    $irradiance_map = [
        "North" => 5.5,
        "North Central" => 5.2,
        "South" => 4.8
    ];
    $peak_sun_hours = $irradiance_map[$validated['selectedRegion']] ?? 5.0; // Default to 6 hours if region not found

    // Battery & Solar Efficiency Constants
    $battery_dod = 0.5; // Depth of Discharge (50% for Lead-Acid, 80% for Lithium-ion)
    $battery_efficiency = 0.9; // 90% efficiency
    $inverter_efficiency = 0.9; // 90% efficiency
    $charge_controller_efficiency = 0.95; // 95% efficiency

    // Calculate Night Load Energy Requirement (Wh)
    $night_load_energy = 0;
    $day_load_energy = 0;
    foreach ($validated['loadEntries'] as $entry) {
        $night_load_energy += $entry['power'] * $entry['quantity'] * $entry['hoursNight'];
        $day_load_energy += $entry['power'] * $entry['quantity'] * $entry['hoursDay'];
    }

    // Determine Required Battery Capacity (Ah)
    $battery_capacity = ($night_load_energy) / ($battery_efficiency * $battery_dod * 12); // Assuming 12V default

    // Decide Battery Type & Voltage
    if ($battery_capacity <= (225 * 4)) { // Limit to 4pcs of 12V 225Ah batteries
        $battery_voltage = 12; // Use 12V Gel
        $battery_type = 'Gel';
        $battery_capacity = ($night_load_energy) / ($battery_efficiency * $battery_dod * 12);
        $battery_count = min(ceil($battery_capacity / 225), 4); // Limit max count to 4
    } else {
        $battery_voltage = 51; // Use 51V Lithium-ion
        $battery_type = 'Lithium-Ion';
        $battery_capacity = ($night_load_energy) / ($battery_efficiency * $battery_dod * 51);
        $battery_count = ceil($battery_capacity / 100); // Assuming 100Ah for 51V batteries
    }

    // Calculate Solar Panel Power Required to Charge Battery
    $required_solar_power_for_battery = ($night_load_energy / ($peak_sun_hours * $charge_controller_efficiency));

    // Calculate Total Solar Power Required (Battery Charging + Day Load)
    $total_solar_power = $required_solar_power_for_battery + ($day_load_energy / ($peak_sun_hours * $charge_controller_efficiency));

    // Determine Number of Panels Needed
    $num_panels = ceil($total_solar_power / $validated['selectedPanelSize']);

    // Inverter Sizing (30% Surge Buffer)
    $inverter_sizes = [1500, 2000, 3000, 3500, 5000, 6000, 10000, 15000];
    $required_inverter_size = ceil($validated['totalPower'] * 1.3);
    $inverter_size = min(array_filter($inverter_sizes, function($size) use ($required_inverter_size) {
        return $size >= $required_inverter_size;
    }));

    // Save Technician Request
    $technicianRequest = LoadAuditGeneration::create([
        'user_id' => auth()->id(),
        'request_code' => Str::uuid(),
        'region_selection' => $validated['selectedRegion'],
        'solar_panel_size_preference' => $validated['selectedPanelSize'],
        'inverter_type_selection' => $validated['selectedInverterType'],
        'total_max_power' => $validated['totalPower'],
        'total_load_consumption' => $validated['totalLoadConsumption'],
        'battery_capacity_ah' => round($battery_capacity, 2),
        'battery_voltage' => $battery_voltage,
        'battery_type' => $battery_type,
        'battery_count' => $battery_count,
        'required_solar_panel_power_w' => round($total_solar_power, 2),
        'number_of_panels' => $num_panels,
        'recommended_inverter_size_w' => $inverter_size,
    ]);

    // Save Load Entries
    foreach ($validated['loadEntries'] as $entry) {
        LoadEntry::create([
            'load_audit_generation_id' => $technicianRequest->id,
            'equipment_name' => $entry['name'],
            'quantity' => $entry['quantity'],
            'power' => $entry['power'],
            'hours_day' => $entry['hoursDay'],
            'hours_night' => $entry['hoursNight'],
        ]);
    }

    // Return JSON Response
    return response()->json([
        "Battery Capacity (Ah)" => round($battery_capacity, 2),
        "Battery Voltage (V)" => $battery_voltage,
        "Battery Type" => $battery_type,
        "Battery Count" => $battery_count,
        "Required Solar Panel Power (W)" => round($total_solar_power, 2),
        "Number of Panels" => $num_panels,
        "Recommended Inverter Size (W)" => $inverter_size,
        "request_id" => $technicianRequest->id
    ]);
}


}
