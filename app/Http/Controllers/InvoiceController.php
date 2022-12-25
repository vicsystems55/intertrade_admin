<?php

namespace App\Http\Controllers;

use App\Models\Invoice;
use App\Models\InvoiceLine;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\StoreInvoiceRequest;
use App\Http\Requests\UpdateInvoiceRequest;

class InvoiceController extends Controller
{
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

            return Invoice::with('invoice_line.product')->get();



        }
        try {
            //code...
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

            if ($request->type == 'add-product') {
                # code...
                InvoiceLine::updateOrCreate([
                    'invoice_id' => $request->invoice_id,
                    'product_id' => $request->product_id,

                ],[
                    'invoice_id' => $request->invoice_id,
                    'description' => 'desc',
                    'product_id' => $request->product_id,
                    'quantity' => 1,
                    'amount' => 20000,
                    'discount_percent' => 0,
                    'discount_amount' => 0,

                ]);

                $invoice_sum = InvoiceLine::where('invoice_id', $request->invoice_id)->get()->sum('amount');

                // please refactor add amount to invoice

                Invoice::find($request->invoice_id)->update([
                    'discount_amount' => $invoice_sum
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
    public function destroy(Invoice $invoice)
    {
        //
    }
}
