<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Notification;
use Illuminate\Http\Request;
use App\Imports\ProductsImport;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Facades\Excel;
use App\Http\Requests\StoreProductRequest;
use App\Http\Requests\UpdateProductRequest;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        return Product::latest()->withSum('stock', 'quantity')->get();
    }


    public function search(Request $request){


        $products = Product::where('product_category_id', $request->productCategoryId)->latest()->get();

        return $products;

    }

    public function searchKeyword(Request $request){

       
        $query = $request->input('searchKey'); // Get search query from request

        $products = Product::where('name', 'LIKE', "%{$query}%")
            ->orWhere('description', 'LIKE', "%{$query}%")
            ->get();

        return $products;

    }

    public function create_product(Request $request){

        $doc = $request->file('product_image');

        $new_name = rand().".".$doc->getClientOriginalExtension();

        $file1 = $doc->move(('products'), $new_name);

        $product = Product::create([
            'product_category_id' => $request->product_category_id,
            'name' => $request->name,
            'description' => $request->description,
            'price' => $request->price,
            'type' => $request->type,
            'color' => $request->color,
            'dimension' => $request->dimension,
            'other_description' => $request->other_description,
            'model' => $request->model,
            'serial_number' => $request->serial_number,
            'featured_image' => '/products/'.$new_name,
        ]);

        Notification::create([
            'user_id' => Auth::user()->id,
            'title' => 'New Product Alert',
            'body' => 'A new product has been added to the store'
        ]);



        return back()->with('msg2', 'New product regisered successfully.');

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreProductRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreProductRequest $request)
    {
        //
        $doc = $request->file('excelDoc');

        $new_name = rand().".".$doc->getClientOriginalExtension();

        $file1 = $doc->move(public_path('uploaded_excel'), $new_name);

        Excel::import(new ProductsImport, asset('uploaded_excel/'.$new_name));



    }

    public function updateProduct(Request $request)
    {


        return $request->all();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function show(Product $product)
    {
        //

        Excel::import(new SiteImport, 'sites.xlsx');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateProductRequest  $request
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateProductRequest $request, Product $product)
    {
        //

        $product->update([
            'name' => $request->productName,
            'description' => $request->productDescription,
            'product_category_id' => $request->productCategory,
            'price' => $request->productPrice,

        ]);

        return $product;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product $product)
    {
        //
    }


    public function updateProductImage(Request $request){

        // return $request->all();

        $doc = $request->file('selected_product_img');

        $new_name = rand().".".$doc->getClientOriginalExtension();

        $file1 = $doc->move(('products'), $new_name);


        $product = Product::find($request->selected_product_id)->update([
            'featured_image' => '/products/'.$new_name,
        ]);

        return $product;

    }
}
