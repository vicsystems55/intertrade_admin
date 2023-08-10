<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\User;
use App\Models\Stock;
use App\Models\Invoice;
use App\Models\Customer;
use App\Models\InvoiceLine;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use App\Mail\AccountNotificationMail;
use App\Http\Requests\StoreInvoiceLineRequest;
use App\Http\Requests\UpdateInvoiceLineRequest;


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

            // return $request->vat_included;


            //code...
            for ($i = 0; $i < count($request->lineIds); $i++) {
                # code...
                $invoice_line = InvoiceLine::find($request->lineIds[$i]);

                $invoice_line->update([
                    'description' => $request->lineDescription[$i],
                    'quantity' => $request->lineQuantity[$i],
                    'amount' => $request->linePrice[$i],
                    'total_amount' => $request->lineQuantity[$i] * $request->linePrice[$i]

                ]);
            }

            $updatedInvoice = Invoice::find($request->invoice_id)->update([
                'total_amount' => InvoiceLine::where('invoice_id', $request->invoice_id)->get()->sum('total_amount'),
                'bank_name' => $request->bank_name,
                'account_name' => $request->account_name,
                'status' => $request->payment_status,
                'account_no' => $request->account_no,
                'vat_included' => $request->vat_included,
                'invoice_type' => $request->invoice_type,
                'customer_id' => $request->customer_id
            ]);

            $genInvoice = Invoice::with('invoice_line')->find($request->invoice_id);

            $data = [

                'total_amount' => $genInvoice->total_amount,
                'doc_type' => $genInvoice->invoice_type,
                'customer_name' => Customer::find($request->customer_id)->contact_person_name,
                'report_by' => User::find($request->user_id)->name,
                'link' => config('app.url').'invoice/'.$genInvoice->invoice_code


            ];

            Mail::to('victor@intertradeltd.biz')->send(new AccountNotificationMail($data));
            // Mail::to('felix@intertradeltd.biz')->send(new AccountNotificationMail($data));
            Mail::to('ojomargret@intertradeltd.biz')->send(new AccountNotificationMail($data));
            // Mail::to('ogedegbeejiro@intertradeltd.biz')->send(new AccountNotificationMail($data));






            if ($genInvoice->invoice_type == 'receiptx') {


                # code...

                # code...
                foreach ($genInvoice->invoice_line as $invoice_line) {

                    if (Stock::where('product_id', $invoice_line->product_id)->first()) {

                        Stock::create([
                            'product_id' => $invoice_line->product_id,
                            'quantity' => ($invoice_line->quantity) * (-1),
                            'invoice_id' => $request->invoice_id,
                            'type' => 'out',
                            'date_received' => Carbon::now()

                        ]);
                    }
                }

                try {
                    //code...

                    $data = [

                        'total_amount' => $genInvoice->total_amount,
                        'doc_type' => $genInvoice->invoice_type,
                        'customer_name' => Customer::find($request->customer_id)->contact_person_name,
                        'report_by' => User::find($request->user_id)->name,
                        'link' => config('app.url').'invoice/'.$genInvoice->invoice_code



                    ];


                    // Mail::to('victor@intertradeltd.biz')->send(new AccountNotificationMail($data));

                    // Mail::to('felix@intertradeltd.biz')->send(new AccountNotificationMail($data));

                    // Mail::to('ojomargret@intertradeltd.biz')->send(new AccountNotificationMail($data));

                    // Mail::to('ogedegbeejiro@intertradeltd.biz')->send(new AccountNotificationMail($data));



                } catch (\Throwable $th) {
                    //throw $th;


                }
            }


            if ($request->generate_receipt === true) {
                # code...

                                # code...

                # code...
                foreach ($genInvoice->invoice_line as $invoice_line) {

                    if (Stock::where('product_id', $invoice_line->product_id)->first()) {

                        Stock::create([
                            'product_id' => $invoice_line->product_id,
                            'quantity' => ($invoice_line->quantity) * (-1),
                            'invoice_id' => $request->invoice_id,
                            'type' => 'out',
                            'date_received' => Carbon::now()

                        ]);
                    }
                }


                // register the same invoice duplicate as receipt

                Invoice::create([
                    'invoice_code' => $genInvoice->invoice_code,
                    'generated_by' => $genInvoice->generated_by,
                    'customer_id' => $genInvoice->customer_id,
                    'invoice_type' => 'receipt',
                    'status' => $genInvoice->status,
                    'payment_type' => $genInvoice->payment_type,
                    'bank_details' => $genInvoice->bank_details,
                    'bank_name' => $genInvoice->bank_name,
                    'account_name' => $genInvoice->account_name,
                    'account_no' => $genInvoice->account_no,
                    'vat_included' => $genInvoice->vat_included,
                    'discount_percent' => $genInvoice->discount_percent,
                    'total_amount' => $genInvoice->total_amount,
                    'discount_amount' => $genInvoice->discount_amount,
                ]);

                try {
                    //code...

                    $data = [

                        'total_amount' => $genInvoice->total_amount,
                        'doc_type' => 'receipt',
                        'customer_name' => Customer::find($request->customer_id)->contact_person_name,
                        'report_by' => User::find($request->user_id)->name,
                        'link' => config('app.url').'invoice/'.$genInvoice->invoice_code



                    ];


                    Mail::to('victor@intertradeltd.biz')->cc(['victorasuquob@gmail.com'])->send(new AccountNotificationMail($data));

                    // Mail::to('felix@intertradeltd.biz')->send(new AccountNotificationMail($data));

                    Mail::to('ojomargret@intertradeltd.biz')->send(new AccountNotificationMail($data));

                    // Mail::to('ogedegbeejiro@intertradeltd.biz')->send(new AccountNotificationMail($data));



                } catch (\Throwable $th) {
                    //throw $th;


                }


            }





            return $request->all();
        }
        if ($request->type == 'remove-item') {
            return InvoiceLine::find($request->invoice_line_id)->delete();
        }
    }

    public function mark_as_paid(Request $request){

        $genInvoice = Invoice::find($request->invoice_id);


            # code...
            foreach ($genInvoice->invoice_line as $invoice_line) {

                if (Stock::where('product_id', $invoice_line->product_id)->first()) {

                    Stock::create([
                        'product_id' => $invoice_line->product_id,
                        'quantity' => ($invoice_line->quantity) * (-1),
                        'invoice_id' => $request->invoice_id,
                        'type' => 'out',
                        'date_received' => Carbon::now()

                    ]);
                }
            }


            // register the same invoice duplicate as receipt

            Invoice::create([
                'invoice_code' => $genInvoice->invoice_code,
                'generated_by' => $genInvoice->generated_by,
                'customer_id' => $genInvoice->customer_id,
                'invoice_type' => 'receipt',
                'status' => $genInvoice->status,
                'payment_type' => $genInvoice->payment_type,
                'bank_details' => $genInvoice->bank_details,
                'bank_name' => $genInvoice->bank_name,
                'account_name' => $genInvoice->account_name,
                'account_no' => $genInvoice->account_no,
                'vat_included' => $genInvoice->vat_included,
                'discount_percent' => $genInvoice->discount_percent,
                'total_amount' => $genInvoice->total_amount,
                'discount_amount' => $genInvoice->discount_amount,
            ]);

            try {
                //code...

                $data = [

                    'total_amount' => $genInvoice->total_amount,
                    'doc_type' => 'receipt',
                    'customer_name' => Customer::find($genInvoice->customer_id)->contact_person_name,
                    'report_by' => Auth::user()->name,
                    'link' => config('app.url').'invoice/'.$genInvoice->id



                ];


                Mail::to('victor@intertradeltd.biz')->send(new AccountNotificationMail($data));

                // Mail::to('felix@intertradeltd.biz')->send(new AccountNotificationMail($data));

                Mail::to('ojomargret@intertradeltd.biz')->send(new AccountNotificationMail($data));

                // Mail::to('ogedegbeejiro@intertradeltd.biz')->send(new AccountNotificationMail($data));



            } catch (\Throwable $th) {
                //throw $th;


            }


            return back()->with('msg', 'Receipt generated');




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
