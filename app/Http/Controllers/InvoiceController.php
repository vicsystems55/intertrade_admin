<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Invoice;
use App\Models\Product;
use App\Models\InvoiceLine;
use Illuminate\Http\Request;
use App\Mail\WeeklySalesReportMail;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use App\Http\Requests\StoreInvoiceRequest;
use App\Http\Requests\UpdateInvoiceRequest;

class InvoiceController extends Controller
{

    public function weekly_report(){




        $weekly_sales = Invoice::
        where('invoice_type', 'receipt')
        ->with(['invoice_line.product', 'customer'])
        ->whereYear('created_at', Carbon::now()->year)
        ->whereMonth('created_at', Carbon::now()->month)
        ->whereBetween('created_at', [Carbon::now()->startOfWeek(), Carbon::now()->endOfWeek()])
        ->get();

        $total_orders = $weekly_sales->count();

        $weekly_sales = Invoice::whereIn('invoice_code', $weekly_sales->pluck('invoice_code'))
        ->where('invoice_type', 'Invoice')
        ->with(['invoice_line.product', 'customer'])
        ->get();

        $productIds = $weekly_sales->flatMap(function ($invoice) {
            return $invoice->invoice_line->pluck('product_id');
        });

        // return $productIds;
        $occurrences = array_count_values($productIds->all());
        // return $occurrences;

        // Find the most occurring item
        $mostOccurringItem = array_search(max($occurrences), $occurrences);

        $mostSoldProduct = Product::find($mostOccurringItem);

        // return $mostOccurringItem;

        $total_sales_amount = $weekly_sales->sum('total_amount');

        try {
            //code...

            Mail::to([
                'victor@intertradeltd.biz',
                'grace@intertradeltd.biz',
                'eghosa@intertradeltd.biz',
                'ogedegbeejiro@intertradeltd.biz',
                'felix@intertradeltd.biz'
            ])->send(new WeeklySalesReportMail(compact('weekly_sales', 'total_sales_amount', 'total_orders', 'mostSoldProduct')));

        } catch (\Throwable $th) {
            //throw $th;
        }



        // return compact('weekly_sales', 'total_sales_amount', 'total_orders', 'mostSoldProduct');




    }
    public function salesRecords(Request $request)
    {
        $period = $request->get('period', 'month');
        $date = $request->get('date');

        switch ($period) {
            case 'week':
                $start = $date ? Carbon::parse($date)->startOfWeek(Carbon::SUNDAY) : Carbon::now()->startOfWeek(Carbon::SUNDAY);
                $end = $date ? Carbon::parse($date)->endOfWeek(Carbon::SATURDAY) : Carbon::now()->endOfWeek(Carbon::SATURDAY);
                $labels = collect(['Sun', 'Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat'])->toArray();
                $sales = array_fill(0, 7, 0);
                $orders = array_fill(0, 7, 0);
                break;
            case 'year':
                $reference = $date ? Carbon::parse($date) : Carbon::now();
                $start = $reference->copy()->startOfYear();
                $end = $reference->copy()->endOfYear();
                $labels = collect(['JAN', 'FEB', 'MAR', 'APR', 'MAY', 'JUN', 'JUL', 'AUG', 'SEP', 'OCT', 'NOV', 'DEC'])->toArray();
                $sales = array_fill(0, 12, 0);
                $orders = array_fill(0, 12, 0);
                break;
            case 'day':
                $reference = $date ? Carbon::parse($date) : Carbon::now();
                $start = $reference->copy()->startOfDay();
                $end = $reference->copy()->endOfDay();
                $labels = array_map(fn ($hour) => sprintf('%02d:00', $hour), range(0, 23));
                $sales = array_fill(0, 24, 0);
                $orders = array_fill(0, 24, 0);
                break;
            case 'month':
            default:
                $reference = $date ? Carbon::parse($date) : Carbon::now();
                $start = $reference->copy()->startOfMonth();
                $end = $reference->copy()->endOfMonth();
                $daysInMonth = $reference->daysInMonth;
                $labels = array_map('strval', range(1, $daysInMonth));
                $sales = array_fill(0, $daysInMonth, 0);
                $orders = array_fill(0, $daysInMonth, 0);
                break;
        }

        $receiptInvoices = Invoice::where('invoice_type', 'receipt')
            ->whereBetween('created_at', [$start, $end])
            ->get(['total_amount', 'created_at']);

        $orderInvoices = Invoice::where('invoice_type', '!=', 'receipt')
            ->whereBetween('created_at', [$start, $end])
            ->get(['total_amount', 'created_at']);

        foreach ($receiptInvoices as $invoice) {
            $createdAt = Carbon::parse($invoice->created_at);

            switch ($period) {
                case 'week':
                    $sales[$createdAt->dayOfWeek] += $invoice->total_amount;
                    break;
                case 'year':
                    $sales[$createdAt->month - 1] += $invoice->total_amount;
                    break;
                case 'day':
                    $sales[$createdAt->hour] += $invoice->total_amount;
                    break;
                default:
                    $sales[$createdAt->day - 1] += $invoice->total_amount;
                    break;
            }
        }

        foreach ($orderInvoices as $invoice) {
            $createdAt = Carbon::parse($invoice->created_at);

            switch ($period) {
                case 'week':
                    $orders[$createdAt->dayOfWeek] += $invoice->total_amount;
                    break;
                case 'year':
                    $orders[$createdAt->month - 1] += $invoice->total_amount;
                    break;
                case 'day':
                    $orders[$createdAt->hour] += $invoice->total_amount;
                    break;
                default:
                    $orders[$createdAt->day - 1] += $invoice->total_amount;
                    break;
            }
        }

        $titles = [
            'week' => 'Weekly Report',
            'month' => 'Monthly Report',
            'year' => 'Yearly Report',
            'day' => 'Daily Report',
        ];

        return response()->json([
            'period' => $period,
            'title' => $titles[$period] ?? 'Sales Report',
            'labels' => $labels,
            'sales' => array_values($sales),
            'orders' => array_values($orders),
        ]);
    }

    public function mail_invoice(Request $request)
    {
        # code...




        return back()->with('msg', 'Invoice has been mailed');
    }

    public function invoice($invoice_id)
    {
        # code...

        $invoice = Invoice::with(['invoice_line.product', 'customer'])->where('id', $invoice_id)->first();

        if ($invoice == null) {
            # code...

        $invoice = Invoice::with(['invoice_line.product', 'customer'])->where('invoice_code', $invoice_id)->first();

        }

        $invoice_descriptionx = Invoice::with('invoice_line')->where('invoice_code', $invoice->invoice_code)->where('invoice_type', 'invoice')->first();
        $description = [];
        $has_receipt = Invoice::where('invoice_type', 'receipt')->where('invoice_code', $invoice->invoice_code)->first()?true:false;

        try {
            //code...
            foreach ($invoice_descriptionx->invoice_line as $desc ) {
                # code...
                array_push($description, $desc->description);
            }
        } catch (\Throwable $th) {
            //throw $th;
        }

        // return $description;
        $invoice_description = implode(',',$description);

        // return $invoice_description;

        return view('reports.invoice', compact('invoice', 'invoice_description', 'has_receipt'));
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
