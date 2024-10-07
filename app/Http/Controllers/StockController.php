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
    public function index()
    {
        //

        $stocks = Stock::where('invoice_id', '!=', null )->with(['invoice','receiver'])->get();

        $total = Invoice::whereIn('id', $stocks->pluck('invoice_id'))->get()->sum('total_amount');

        $orders = Invoice::where('customer_id','!=',null)->get();

        $customers = Customer::get();



        // return $total;

        $products = Product::has('stock')->with(['stock','category'])->orderBy('product_category_id', 'asc')->get();

        // return $products;

        $total_stock = [];

        foreach ($products as $product) {
            # code...

            $product_quantity = Stock::where('product_id', $product->id)->get()->sum('quantity');

            $productStockSum = $product->price * $product_quantity;

            array_push($total_stock, $productStockSum);



        }

        $total_stock = array_sum($total_stock);




        // return $products_in_stock;

        return view('admin_dashboard.stockManagement', compact(['products','stocks', 'total', 'orders', 'customers', 'total_stock']));
    }


    public function export_stock(){

        return Excel::download(new StockExport, Carbon::now()->format('d-m-y').'Stock Report.xlsx');
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
