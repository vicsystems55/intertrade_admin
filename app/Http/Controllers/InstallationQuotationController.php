<?php

namespace App\Http\Controllers;



use App\Models\Customer;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Imports\QuotationImport;
use App\Models\GeneratedQuation;
use Maatwebsite\Excel\Facades\Excel;
use App\Models\InstallationQuotation;
use Illuminate\Support\Facades\Validator;

class InstallationQuotationController extends Controller
{
    //

    public function create()
    {

        $quotation_templates = InstallationQuotation::select('quotation_code', 'system_capacity')
        ->distinct()
        ->get();

        return view('superadmin_dashboard.quotations.create', compact('quotation_templates'));
    }

    public function generate(Request $request){

        $quotation_code = $request->quotation_code;


        $template = InstallationQuotation::where('quotation_code', $request->quotation_code)->get();
        $system_capacity = InstallationQuotation::where('quotation_code', $request->quotation_code)->first()->system_capacity;

        // return  $system_capacity;

        return view('superadmin_dashboard.quotations.generate', compact('template', 'quotation_code', 'system_capacity'));

    }
    public function update_generated_quote(Request $request)
    {

        // return $request->all();
        // register customer or update

        $customer = Customer::updateOrCreate(
            [
                'contact_person_name' => $request->customer_name,
                'company_name' => $request->customer_company_name,
            ],[

                'contact_person_name' => $request->customer_name,
                'company_name' => $request->customer_company_name,
                'contact_person_name' => $request->customer_name,
                'business_email' => $request->customer_email,
                'business_phone1' => $request->customer_phone,
                'contact_person_phone' => $request->customer_phone,
                'address' => $request->customer_address,

        ]);;

        $customer_quotation_code = rand(1000,99999);

        // return $request->all();
        foreach ($request->quotations as $quotationData) {
            // GeneratedQuation::where('id', $quotationData['id'])
            //     ->update([
            //         'quantity' => $quotationData['quantity'],
            //         'unit_price' => $quotationData['unit_price'],
            //         'total_price' => $quotationData['quantity'] * $quotationData['unit_price'],
            //     ]);

            if(isset($quotationData['unit_price'])){

                GeneratedQuation::create([
                    'customer_id' => $customer->id,
                    'quotation_code' => $request->quotation_code,
                    'customer_quotation_code' =>  $customer_quotation_code,
                    'system_capacity' => $request->system_capacity,
                    'item_description' => $quotationData['description'],
                    'quantity' => $quotationData['quantity']??1,
                    'unit_price' => $quotationData['unit_price'],
                    'total_price' => $quotationData['quantity']??1 * ($quotationData['unit_price']),
                    'total_cost' => 0,
                    'category' => 'Main',

                ]);
            }





        }

        return redirect()->route('quotations.fetch')->with('success', 'Quotation updated successfully!');
    }

    public function view_quotation(Request $request){

        $quotation_data = GeneratedQuation::where('customer_quotation_code', $request->customer_quotation_code);

        $quotation_details = $quotation_data->get();

        $customer = GeneratedQuation::with('customer') // Load customer relationship
        ->select('customer_id', 'customer_quotation_code', 'quotation_code', 'created_at')
        ->groupBy('customer_id', 'customer_quotation_code', 'quotation_code', 'created_at')
        ->orderBy('created_at', 'desc')
        ->first();

        // return $customer;
        $customer_quotation_code = $customer->customer_quotation_code;



        // Retrieve specific costs
        $total_material_cost = GeneratedQuation::where('customer_quotation_code', $request->customer_quotation_code)->where('item_description', 'Total Installtion material cost')->first();
        $total_material_cost_price = $total_material_cost ? $total_material_cost->total_price : 0;

        $installation_cost = GeneratedQuation::where('customer_quotation_code', $request->customer_quotation_code)->where('item_description', 'Installation')->first();
        $installation_cost_price = $installation_cost ? $installation_cost->unit_price : 0;

        $total_cost = GeneratedQuation::where('customer_quotation_code', $request->customer_quotation_code)->where('item_description', 'Total')->first();
        $total_cost_price = $total_cost ? $total_cost->unit_price : 0;

        $grand_total = GeneratedQuation::where('customer_quotation_code', $request->customer_quotation_code)->where('item_description', 'Total Cost of Installation')->first();
        $grand_total_price = $grand_total ? $grand_total->total_price : 0;

        // return $installation_cost_price;


        return view('superadmin_dashboard.quotations.details',
        compact('quotation_details',
                'customer',
                'customer_quotation_code',
                'total_material_cost_price',
                'installation_cost_price',
                'total_cost_price',
                'grand_total_price'));

    }
    public function quotations()
    {

        $quotations = GeneratedQuation::with('customer') // Load customer relationship
        ->select('customer_id', 'customer_quotation_code', 'quotation_code', 'created_at')
        ->groupBy('customer_id', 'customer_quotation_code', 'quotation_code', 'created_at')
        ->orderBy('created_at', 'desc')
        ->get();




        return view('superadmin_dashboard.quotations.index', compact('quotations'));
    }
    public function quotation_templates()
    {

        $quotation_templates = InstallationQuotation::select('quotation_code', 'system_capacity')
        ->distinct()
        ->get();


        return view('superadmin_dashboard.quotations.templates', compact('quotation_templates'));
    }

    public function import_quotes(Request $request)
    {

        return 123;
    }

    public function import_template(Request $request)
    {
        // Validate the uploaded file
        $validator = Validator::make($request->all(), [
            'file' => 'required|mimes:xlsx,xls,csv|max:2048',
        ]);

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        try {
            // Load the file and process data with calculated formulas
            Excel::import(new QuotationImport, $request->file('file'));

            return back()->with('success', 'Solar quotations imported successfully.');
        } catch (\Exception $e) {
            return back()->withErrors(['error' => $e->getMessage()]);
        }
    }
}
