<?php

namespace App\Http\Controllers;

use App\Models\Invoice;
use App\Models\InvoiceLine;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\StoreInvoiceLineRequest;
use App\Http\Requests\UpdateInvoiceLineRequest;
use App\Models\Stock;
use Carbon\Carbon;

class InvoiceLineController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreInvoiceLineRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreInvoiceLineRequest $request)
    {
        //

        if ($request->type == 'update-line') {
            # code...

            try {
                //code...
                for ($i=0; $i < count($request->lineIds); $i++) { 
                    # code...
                    $invoice_line = InvoiceLine::find($request->lineIds[$i]);
    
                    $invoice_line->update([
                        'description' => $request->lineDescription[$i],
                        'quantity' => $request->lineQuantity[$i],
                        'amount' => $request->linePrice[$i],
                        'total_amount' => $request->lineQuantity[$i] * $request->linePrice[$i]

    
                    ]);


                }

                Invoice::find($request->invoice_id)->update([
                    'total_amount' => InvoiceLine::where('invoice_id', $request->invoice_id)->get()->sum('total_amount'),
                    'bank_name' => $request->bank_name,
                    'account_name' => $request->account_name,
                    'status' => $request->payment_status,
                    'account_no' => $request->account_no,
                    'invoice_type' => $request->invoice_type,
                    'customer_id' => $request->customer_id
                ]);

                $genInvoice = Invoice::with('invoice_line')->find($request->invoice_id);




                if ($genInvoice->invoice_type == 'receipt') {


                    # code...
                
                        # code...
                        foreach ($genInvoice->invoice_line as $invoice_line ) {

                            if (Stock::where('product_id', $invoice_line->product_id)->first()) {
                            
                            Stock::create([
                                'product_id' => $invoice_line->product_id,
                                'quantity' => ($invoice_line->quantity)*(-1),
                                'invoice_id' => $request->invoice_id,
                                'type' => 'out',
                                'date_received' => Carbon::now()
                                
                            ]);
                        }
                    }



                }

            } catch (\Throwable $th) {
                //throw $th;

                return $th;
            }

            

            return $request->all();
        }
        if($request->type== 'remove-item'){
            return InvoiceLine::find($request->invoice_line_id)->delete();
        }

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\InvoiceLine  $invoiceLine
     * @return \Illuminate\Http\Response
     */
    public function show(InvoiceLine $invoiceLine)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateInvoiceLineRequest  $request
     * @param  \App\Models\InvoiceLine  $invoiceLine
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateInvoiceLineRequest $request, InvoiceLine $invoiceLine)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\InvoiceLine  $invoiceLine
     * @return \Illuminate\Http\Response
     */
    public function destroy(InvoiceLine $invoiceLine)
    {
        //
    }
}
