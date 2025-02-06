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
                    'item_description' => $quotationData['description']??'',
                    'quantity' => $quotationData['quantity']??0,
                    'unit_price' => $quotationData['unit_price']??0,
                    'total_price' => $quotationData['quantity']??0 * ($quotationData['unit_price'])??0,
                    'total_cost' => 0,
                    'category' => 'Main',

                ]);
            }





        }

        return redirect()->route('quotations.fetch')->with('success', 'Quotation updated successfully!');
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
