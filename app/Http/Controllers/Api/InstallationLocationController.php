<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\InstallationLocation;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\DB;

class InstallationLocationController extends Controller
{
    /**
     * Get all installation locations
     */
    public function index(Request $request)
    {
        $query = InstallationLocation::where('status', 'active');

        // Filter by project type
        if ($request->has('project_type') && $request->project_type !== 'all') {
            $query->where('project_type', $request->project_type);
        }

        $locations = $query->get();
        return response()->json($locations);
    }

    /**
     * Get location statistics
     */
    public function statistics()
    {
        $stats = [
            'total' => InstallationLocation::where('status', 'active')->count(),
            'solar' => InstallationLocation::where('status', 'active')
                ->where('project_type', 'solar')->count(),
            'cold_chain' => InstallationLocation::where('status', 'active')
                ->where('project_type', 'cold_chain')->count(),
        ];

        return response()->json($stats);
    }

    /**
     * Store a newly created location
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'project_name' => 'required|string',
            'location_name' => 'required|string',
            'latitude' => 'required|numeric',
            'longitude' => 'required|numeric',
            'project_type' => 'required|in:solar,cold_chain',
            'description' => 'nullable|string',
            'state' => 'nullable|string',
            'local_government' => 'nullable|string',
            'installation_date' => 'nullable|date',
        ]);

        $location = InstallationLocation::create($validated);

        return response()->json([
            'message' => 'Location created successfully',
            'data' => $location
        ], 201);
    }

    /**
     * Update installation location
     */
    public function update(Request $request, $id)
    {
        $location = InstallationLocation::findOrFail($id);

        $validated = $request->validate([
            'project_name' => 'string',
            'location_name' => 'string',
            'latitude' => 'numeric',
            'longitude' => 'numeric',
            'project_type' => 'in:solar,cold_chain',
            'description' => 'nullable|string',
            'state' => 'nullable|string',
            'local_government' => 'nullable|string',
            'installation_date' => 'nullable|date',
        ]);

        $location->update($validated);

        return response()->json([
            'message' => 'Location updated successfully',
            'data' => $location
        ]);
    }

    /**
     * Delete installation location
     */
    public function destroy($id)
    {
        $location = InstallationLocation::findOrFail($id);
        $location->update(['status' => 'inactive']);

        return response()->json([
            'message' => 'Location deleted successfully'
        ]);
    }

    /**
     * Upload Excel file with locations
     */
    public function uploadExcel(Request $request)
    {
        $request->validate([
            'file' => 'required|file|mimes:xlsx,xls,csv'
        ]);

        try {
            $locations = Excel::toArray([], $request->file('file'));
            $success = 0;
            $errors = [];

            foreach ($locations[0] ?? [] as $index => $row) {
                if ($index < 1) continue; // Skip header

                try {
                    if (!isset($row[0]) || !isset($row[1]) || !isset($row[2]) || !isset($row[3])) {
                        $errors[] = "Row " . ($index + 1) . ": Missing required fields";
                        continue;
                    }

                    InstallationLocation::create([
                        'project_name' => $row[0],
                        'location_name' => $row[1],
                        'latitude' => floatval($row[2]),
                        'longitude' => floatval($row[3]),
                        'project_type' => $row[4] ?? 'solar',
                        'description' => $row[5] ?? null,
                        'state' => $row[6] ?? null,
                        'local_government' => $row[7] ?? null,
                        'installation_date' => $row[8] ?? null,
                    ]);
                    $success++;
                } catch (\Exception $e) {
                    $errors[] = "Row " . ($index + 1) . ": " . $e->getMessage();
                }
            }

            return response()->json([
                'message' => "Uploaded successfully. {$success} records created.",
                'success_count' => $success,
                'errors' => $errors
            ], 201);

        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Error processing file: ' . $e->getMessage()
            ], 400);
        }
    }

    /**
     * Export locations as Excel
     */
    public function exportExcel(Request $request)
    {
        $query = InstallationLocation::where('status', 'active');

        if ($request->has('project_type') && $request->project_type !== 'all') {
            $query->where('project_type', $request->project_type);
        }

        $locations = $query->get();

        $filename = 'installation_locations_' . date('Y_m_d_His') . '.xlsx';

        return Excel::download(new \App\Exports\InstallationLocationsExport($locations), $filename);
    }
}

