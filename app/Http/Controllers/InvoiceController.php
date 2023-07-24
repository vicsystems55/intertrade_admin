<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Invoice;
use App\Models\Product;
use App\Models\InvoiceLine;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\StoreInvoiceRequest;
use App\Http\Requests\UpdateInvoiceRequest;

class InvoiceController extends Controller
{

    public function salesRecords() {

        $monthly_sales = [];

        for ($i=1; $i < 13; $i++) {
            # code...
            $month_count = Invoice::whereYear('created_at', Carbon::now()->year)->whereMonth('created_at', $i)->get()->sum('total_amount');

            array_push($monthly_sales, $month_count);

        }

        return $monthly_sales;

    }

    public function mail_invoice(Request $request)
    {
        # code...




        return back()->with('msg', 'Invoice has been mailed');
    }

    public function invoice($invoice_code)
    {
        # code...

        $invoice = Invoice::with(['invoice_line.product', 'customer'])->where('invoice_code', $invoice_code)->first();

        // return $invoice;

        return view('reports.invoice', compact('invoice'));
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        //

        // return $request->all();
        if ($request->type == 'all') {
            # code...

            return Invoice::latest()->with('invoice_line.product')->where('customer_id', '!=',null)->where('total_amount','>',0)->with('customer')->get();



        }
        try {
            //code...

            // return $request->all();
            return Invoice::with('invoice_line.product')->where('invoice_code', $request->invoice_code)->first();

        } catch (\Throwable $th) {
            //throw $th;
            return $th;
        }



    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreInvoiceRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreInvoiceRequest $request)
    {
        //

        try {
            //code...
            if ($request->type == 'delete') {
                # code...

                $invoice = Invoice::with('invoice_line')->where('invoice_code', $request->invoice_code)->first();

                // return $invoice;

                InvoiceLine::where('invoice_id', $invoice->id)->delete();

                // $invoice->invoice_line->delete();

                return $invoice->delete();
            }

            if ($request->type == 'add-product') {
                # code...

                // return $request->all();

                $prdct = Product::find($request->product_id);
                InvoiceLine::updateOrCreate([
                    'invoice_id' => $request->invoice_id,
                    'product_id' => $request->product_id,

                ],[
                    'invoice_id' => $request->invoice_id,
                    'description' => $prdct->description,
                    'product_id' => $request->product_id,
                    'quantity' => 1,
                    'amount' => $prdct->price,
                    'discount_percent' => 0,
                    'discount_amount' => 0,

                ]);

                $invoice_sum = InvoiceLine::where('invoice_id', $request->invoice_id)->get()->sum('amount');

                // please refactor add amount to invoice

                Invoice::find($request->invoice_id)->update([
                    'total_amount' => $invoice_sum,



                ]);

            }else{

                return Invoice::create([
                    'invoice_code' => $request->invoice_code,
                    'generated_by' => $request->userid

                ]);
            }



        } catch (\Throwable $th) {
            //throw $th;

            return $th;
        }


    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Invoice  $invoice
     * @return \Illuminate\Http\Response
     */
    public function show(Invoice $invoice)
    {
        //

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateInvoiceRequest  $request
     * @param  \App\Models\Invoice  $invoice
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateInvoiceRequest $request, Invoice $invoice)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Invoice  $invoice
     * @return \Illuminate\Http\Response
     */
    public function destroy(Invoice $invoice_code)
    {
        //r

        $invoice = Invoice::with('invoice_line')->where('invoice_code', $invoice_code)->first();

        $invoice->invoice_line->delete();

        return $invoice->delete();





    }
}
