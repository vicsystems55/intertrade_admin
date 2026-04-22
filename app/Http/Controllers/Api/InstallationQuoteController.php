<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Imports\QuotationImport;
use App\Models\Customer;
use App\Models\GeneratedQuation;
use App\Models\InstallationQuotation;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\Validator;

class InstallationQuoteController extends Controller
{
    /**
     * Generate quotation data for a given quotation_code (API version)
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function generate(Request $request): JsonResponse
    {
        $quotation_code = $request->quotation_code;
        if (!$quotation_code) {
            return response()->json([
                'status' => 'error',
                'message' => 'quotation_code is required.'
            ], 400);
        }

        $template = InstallationQuotation::where('quotation_code', $quotation_code)->get();
        $system_capacity = InstallationQuotation::where('quotation_code', $quotation_code)->first()?->system_capacity;

        if ($template->isEmpty()) {
            return response()->json([
                'status' => 'error',
                'message' => 'No data found for the provided quotation_code.'
            ], 404);
        }

        return response()->json([
            'status' => 'success',
            'message' => 'Quotation data retrieved successfully.',
            'data' => [
                'template' => $template,
                'quotation_code' => $quotation_code,
                'system_capacity' => $system_capacity
            ]
        ], 200);
    }

    /**
     * Store generated quotation (API)
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function update_generate_quote(Request $request): JsonResponse
    {
        // Create or update customer
        $customer = Customer::updateOrCreate(
            [
                'contact_person_name' => $request->customer_name,
                'company_name' => $request->customer_company_name,
            ],[
                'contact_person_name' => $request->customer_name,
                'company_name' => $request->customer_company_name,
                'business_email' => $request->customer_email,
                'business_phone1' => $request->customer_phone,
                'contact_person_phone' => $request->customer_phone,
                'address' => $request->customer_address,
        ]);

        $customer_quotation_code = rand(1000,99999);

        $created = [];

        if (is_array($request->quotations)) {
            foreach ($request->quotations as $quotationData) {
                if (isset($quotationData['unit_price'])) {
                    $g = GeneratedQuation::create([
                        'customer_id' => $customer->id,
                        'quotation_code' => $request->quotation_code,
                        'customer_quotation_code' => $customer_quotation_code,
                        'system_capacity' => $request->system_capacity,
                        'item_description' => $quotationData['description'] ?? null,
                        'quantity' => $quotationData['quantity'] ?? 1,
                        'unit_price' => $quotationData['unit_price'],
                        'total_price' => ($quotationData['quantity'] ?? 1) * ($quotationData['unit_price']),
                        'total_cost' => 0,
                        'category' => 'Main',
                    ]);

                    $created[] = $g;
                }
            }
        }

        return response()->json([
            'status' => 'success',
            'message' => 'Quotation updated successfully.',
            'data' => [
                'customer' => $customer,
                'customer_quotation_code' => $customer_quotation_code,
                'created_count' => count($created),
            ]
        ], 201);
    }

    /**
     * List generated quotations (API)
     *
     * @return JsonResponse
     */
    public function quotations(): JsonResponse
    {
        try {
            $quotations = GeneratedQuation::with('customer')
                ->select('customer_id', 'customer_quotation_code', 'quotation_code', 'system_capacity', 'created_at')
                ->groupBy('customer_id', 'customer_quotation_code', 'quotation_code', 'system_capacity', 'created_at')
                ->orderBy('created_at', 'desc')
                ->get();

            return response()->json([
                'status' => 'success',
                'message' => 'Quotations retrieved successfully.',
                'data' => $quotations
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Failed to retrieve quotations',
                'error' => $e->getMessage(),
            ], 500);
        }
    }

    /**
     * View quotation details (API)
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function view_quotation(Request $request): JsonResponse
    {
        $quotation_data = GeneratedQuation::where('customer_quotation_code', $request->customer_quotation_code);

        $quotation_details = $quotation_data->get();

        $customer = GeneratedQuation::with('customer')
            ->select('customer_id', 'customer_quotation_code', 'quotation_code', 'system_capacity', 'created_at')
            ->groupBy('customer_id', 'customer_quotation_code', 'quotation_code', 'system_capacity', 'created_at')
            ->orderBy('created_at', 'desc')
            ->first();

        if (! $customer) {
            return response()->json([
                'status' => 'error',
                'message' => 'Quotation not found.'
            ], 404);
        }

        $customer_quotation_code = $customer->customer_quotation_code;

        $total_material_cost = GeneratedQuation::where('customer_quotation_code', $request->customer_quotation_code)
            ->where('item_description', 'Total Installtion material cost')
            ->first();
        $total_material_cost_price = $total_material_cost ? $total_material_cost->total_price : 0;

        $installation_cost = GeneratedQuation::where('customer_quotation_code', $request->customer_quotation_code)
            ->where('item_description', 'Installation')
            ->first();
        $installation_cost_price = $installation_cost ? $installation_cost->unit_price : 0;

        $total_cost = GeneratedQuation::where('customer_quotation_code', $request->customer_quotation_code)
            ->where('item_description', 'Total')
            ->first();
        $total_cost_price = $total_cost ? $total_cost->unit_price : 0;

        $grand_total = GeneratedQuation::where('customer_quotation_code', $request->customer_quotation_code)
            ->where('item_description', 'Total Cost of Installation')
            ->first();
        $grand_total_price = $grand_total ? $grand_total->total_price : 0;

        return response()->json([
            'status' => 'success',
            'message' => 'Quotation details retrieved successfully.',
            'data' => [
                'quotation_details' => $quotation_details,
                'customer' => $customer,
                'customer_quotation_code' => $customer_quotation_code,
                'total_material_cost_price' => $total_material_cost_price,
                'installation_cost_price' => $installation_cost_price,
                'total_cost_price' => $total_cost_price,
                'grand_total_price' => $grand_total_price,
            ]
        ], 200);
    }

    /**
     * Import quotation template from Excel file
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function import_template(Request $request): JsonResponse
    {
        // Validate the uploaded file
        $validator = Validator::make($request->all(), [
            'file' => 'required|mimes:xlsx,xls,csv|max:2048',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 'error',
                'message' => 'Validation failed',
                'errors' => $validator->errors(),
            ], 422);
        }

        try {
            // Load the file and process data with calculated formulas
            Excel::import(new QuotationImport, $request->file('file'));

            return response()->json([
                'status' => 'success',
                'message' => 'Solar quotations imported successfully.',
                'data' => []
            ], 201);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Import failed',
                'error' => $e->getMessage(),
            ], 500);
        }
    }

    /**
     * Fetch all imported quotation templates
     *
     * @return JsonResponse
     */
    public function index(): JsonResponse
    {
        try {
            $quotation_templates = InstallationQuotation::select('quotation_code', 'system_capacity')
                ->distinct()
                ->get();

            return response()->json([
                'status' => 'success',
                'message' => 'Quotation templates retrieved successfully.',
                'data' => $quotation_templates
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Failed to retrieve templates',
                'error' => $e->getMessage(),
            ], 500);
        }
    }
}
