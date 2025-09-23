<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\User;
use App\Models\Stock;
use App\Models\Invoice;
use App\Models\Product;
use App\Models\Customer;
use App\Exports\StockExport;
use App\Models\Notification;
use Illuminate\Http\Request;
use App\Models\ProductCategory;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Facades\Excel;


class StockController extends Controller
{
    //
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */


    public function index(Request $request)
    {
        $filter = $request->get('filter', 'all'); // default = all

        // Base queries
        $stocksQuery = Stock::whereNotNull('invoice_id')->with(['invoice', 'receiver']);
        $ordersQuery = Invoice::whereNotNull('customer_id');
        $customersQuery = Customer::query();

        // Apply filter
        switch ($filter) {
            case 'last_week':
                $start = Carbon::now()->subWeek()->startOfWeek();
                $end   = Carbon::now()->subWeek()->endOfWeek();
                $stocksQuery->whereBetween('created_at', [$start, $end]);
                $ordersQuery->whereBetween('created_at', [$start, $end]);
                $customersQuery->whereBetween('created_at', [$start, $end]);
                break;

            case 'last_30_days':
                $start = Carbon::now()->subDays(30);
                $stocksQuery->where('created_at', '>=', $start);
                $ordersQuery->where('created_at', '>=', $start);
                $customersQuery->where('created_at', '>=', $start);
                break;

            case 'last_60_days':
                $start = Carbon::now()->subDays(60);
                $stocksQuery->where('created_at', '>=', $start);
                $ordersQuery->where('created_at', '>=', $start);
                $customersQuery->where('created_at', '>=', $start);
                break;

            case 'last_month':
                $start = Carbon::now()->subMonth()->startOfMonth();
                $end   = Carbon::now()->subMonth()->endOfMonth();
                $stocksQuery->whereBetween('created_at', [$start, $end]);
                $ordersQuery->whereBetween('created_at', [$start, $end]);
                $customersQuery->whereBetween('created_at', [$start, $end]);
                break;

            case 'all':
            default:
                // No filter applied
                break;
        }

        // Run queries
        $stocks = $stocksQuery->get();
        $orders = $ordersQuery->get();
        $customers = $customersQuery->get();

        // Total sales
        $total = Invoice::whereIn('id', $stocks->pluck('invoice_id'))->sum('total_amount');

        // Products with stock
        $products = Product::has('stock')
            ->with(['stock', 'category'])
            ->orderBy('product_category_id', 'asc')
            ->get();

        // Total stock value
        $total_stock = $products->map(function ($product) {
            $product_quantity = Stock::where('product_id', $product->id)->sum('quantity');
            return $product->price * $product_quantity;
        })->sum();

        return view('admin_dashboard.stockManagement', compact([
            'products',
            'stocks',
            'total',
            'orders',
            'customers',
            'total_stock',
            'filter'
        ]));
    }



    public function export_stock()
    {

        return Excel::download(new StockExport, Carbon::now()->format('d-m-y') . 'Stock Report.xlsx');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //

        $products = Product::with('category')->get();

        $productCategories = ProductCategory::get();


        // return $products;

        $users = User::all();

        $stocks = Stock::with('receiver')->where('type', 'in')->paginate(30);

        // return $stocks;

        return view('admin_dashboard.createStock', compact(['stocks', 'products', 'users', 'productCategories']));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreStockRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //

        // return $request->all();

        Stock::create([
            'product_id' => $request->product_id,
            'quantity' => $request->quantity,
            'manufacturer_id' => $request->manufacturer_id,
            'supplier_id' => $request->supplier_id,
            'received_by' => $request->received_by,
            'date_received' => Carbon::parse($request->date_received),
        ]);

        Notification::create([
            'user_id' => Auth::user()->id,
            'title' => 'Stock Notification',
            'body' =>  'New stock have been registered'
        ]);


        return back()->with('msg', 'Stock Registered');
    }

    public function adjustAddStock(Request $request)
    {

        // return $request->all();

        Stock::create([
            'product_id' => $request->product_id,
            'quantity' => $request->quantity,
            'type' => 'in',
            // 'reason' => $request->reason,
            'received_by' => Auth::user()->id,
            'date_received' => Carbon::now(),
        ]);

        Notification::create([
            'user_id' => Auth::user()->id,
            'title' => 'Stock Notification',
            'body' =>  'Stock have been adjusted'
        ]);

        return back()->with('msg-add', 'Stock Adjusted');
    }

    public function adjustRemoveStock(Request $request)
    {




        if ($request->reason == 'sold') {
            $type = 'out';
        } elseif ($request->reason == 'damaged') {
            $type = 'in';
        } elseif ($request->reason == 'expired') {
            $type = 'in';
        } elseif ($request->reason == 'other') {
            $type = 'in';
        }

        Stock::create([
            'product_id' => $request->product_id,
            'quantity' => $request->quantity * -1,
            'type' => $type,
            // 'reason' => $request->reason,
            'received_by' => Auth::user()->id,
            'date_received' => Carbon::now(),
        ]);


        Notification::create([
            'user_id' => Auth::user()->id,
            'title' => 'Stock Notification',
            'body' =>  'Stock have been adjusted reason: ' . $request->reason
        ]);

        return back()->with('msg-remove', 'Stock Adjusted');
    }

    public function updateStockStatus(Request $request)
    {

        // Validate request
        $request->validate([
            'product_id' => 'required|exists:products,id',
            'status'     => 'required|in:confirmed,not confirmed',
        ]);

        // Update all stocks belonging to this product_id
        Stock::where('product_id', $request->product_id)
            ->update(['status' => $request->status]);

        return back()->with('msg-add', 'Stock Status Updated for all records of this product');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Stock  $Stock
     * @return \Illuminate\Http\Response
     */
    public function show(Stock $stock)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Stock  $Stock
     * @return \Illuminate\Http\Response
     */
    public function edit(Stock $stock)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateStockRequest  $request
     * @param  \App\Models\Stock  $Stock
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Stock $stock)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Stock  $Stock
     * @return \Illuminate\Http\Response
     */
    public function destroy(Stock $stock)
    {
        //
    }
}
