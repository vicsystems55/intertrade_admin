@extends('layouts.app')

@section('content')


<div class="page-content">
    <div class="p-3"></div>
    <h4> Add Stock</h4>

<div class="container">
    <div class="row">
        <div class="card col-md-6">

            <div class="card-body ">

                    @if(Session::has('msg'))
                        <p class="alert alert-info">{{ Session::get('msg') }}</p>
                    @endif




                <form action="{{route('stockManagement.store')}}" method="post">
                    @csrf

                    <div class="py-2">
                        <label for="product">Manufacturer</label>
                        <select name="manufacturer_id" id="" class="form-control">
                            <option value="1">Haier Biomedical</option>
                            <option value="2">SMK Technologies</option>
                            <option value="3">OPZV</option>
                            <option value="4">RITAR</option>
                            <option value="5">SCHUTTEN SOLAR</option>
                            <option value="6">R-LFP</option>

                        </select>
                    </div>

                    <div class="py-2">
                        <label for="supplier">Supplier</label>
                        <select name="supplier_id" id="" class="form-control">
                            <option value="1">Haier Biomedical</option>
                            <option value="2">SMK Technologies</option>
                            <option value="3">OPZV</option>
                            <option value="4">RITAR</option>
                            <option value="5">SCHUTTEN SOLAR</option>
                            <option value="6">R-LFP</option>
                        </select>
                    </div>

                    <div class="py-2">
                        <label for="">Select Product</label>
                        <select name="product_id" id="" class="form-control">
                            @foreach ($products as $product)

                            <option value="{{$product->id}}">{{$product->name}}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="py-2">
                        <label for="quantity">Quanity</label>
                        <input type="number" name="quantity" class="form-control" value="">
                    </div>

                    <div class="py-2">
                        <label for="received_by">Received By</label>
                        <select name="received_by" id="" class="form-control">
                            <option value="{{Auth::user()->id}}">Me</option>
                            {{-- @foreach ($users as $user)
                            <option value="{{$user->id}}">{{$user->name}}</option>

                            @endforeach --}}
                        </select>
                    </div>

                    <div class="py-2">
                        <label for="">Date Received</label>
                       <input type="date" name="date_received" min='2023-01-01' class="form-control" id="">
                    </div>

                    <div class="py-2">
                        <button class="btn btn-primary">Submit</button>
                    </div>


                </form>
            </div>
        </div>

        <div class="col-md-6">
            <div class="card">
                <div class="card-body">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Product</th>
                                <th>Quanity</th>
                                <th>Recorder</th>
                                <th>Date</th>
                            </tr>
                        </thead>

                        <tbody>
                            @foreach ($stocks->where('type', 'in') as $stock)
                            <tr>
                                <td>{{$loop->iteration}}</td>
                                <td>{{$stock->product->name}}</td>
                                <td>{{$stock->quantity}}</td>
                                <td>

                                    <img style="height: 20px;" src="{{$stock->receiver->avatar}}" alt=""><br>
                                    {{$stock->receiver->name??''}}</td>
                                <td>{{\Carbon\Carbon::parse($stock->created_at)->diffForHumans()}}</td>
                            </tr>

                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="container">
    <div class=" py-3 d-flex justify-content-between">

        <div class="c">

            <h6>All Products</h6>

            @if(Session::has('msg2'))
            <p class="alert alert-info">{{ Session::get('msg2') }}</p>
            @endif

        </div>

        <div class="bu">
            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#staticBackdrop">
                Add New Product
              </button>
        </div>

    </div>

    <products-component  appurl="{{config('app.url')}}" userid="{{Auth::user()->id}}"  ></products-component>

    {{-- <div class="card">
        <div class="card-body">



            <table class="table">
                <thead>
                    <tr>
                        <th>#</th>
                        <th></th>
                        <th>Product Name</th>
                        <th>Category</th>
                        <th>Price (N)</th>
                        <th></th>

                    </tr>
                </thead>
                <tbody>
                    @foreach ($products as $product)


                    <tr>


                        <td>

                            {{$loop->iteration}}</td>
                        <td>
                            <img src="{{$product->featured_image}}" style="height: 45px" alt="">
                        </td>


                        <td>
                            <input type="text" class="form-control form-control-sm" name="productName{{$product->id}}" value="{{$product->name}}">
                            </td>
                        <td>

                            <select name="productCategory{{$product->id}}" id="" class="form-control form-control-sm" >
                                @foreach ($productCategories as $productCategory)

                                <option value="{{$productCategory->id}}" {{$product->category->id == $productCategory->id?'selected':''}} >{{$productCategory->name}}</option>
                                @endforeach
                            </select>
                        </td>
                        <td>
                            <input type="text" name="productPrice{{$product->id}}" class="form-control form-control-sm" value="{{number_format($product->price,2 )}}">
                        </td>
                        <td>

                            <button type="submit" class="btn btn-secondary  btn-sm">update</button>
                            </td>



                    </tr>



                    @endforeach
                </tbody>
            </table>

        </div>
    </div> --}}
</div>



<div class="modal fade" id="staticBackdrop" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="staticBackdropLabel">Create a new product</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">

            <form method="post"  action="/create-product" enctype="multipart/form-data">

                @csrf

            <div class="form-group">
                <label for="">Product Category</label>
                <select name="product_category_id" id="" class="form-control">

                    @foreach ($productCategories as $category)
                    <option value="{{$category->id}}">{{$category->name}}</option>

                    @endforeach

                </select>
            </div>

            <div class="form-group py-2">
                <label for="">Name</label>
                <input type="text" class="form-control" name="name" placeholder="name">
            </div>

            <div class="form-group py-2">
                <label for="">Description</label>
                <input type="text" class="form-control" name="description" placeholder="description">
            </div>

            <div class="form-group py-2">
                <label for="">Price</label>
                <input type="number" class="form-control" name="price" placeholder="price">
            </div>

            <div class="form-group py-2">
                <label for="">Type</label>
                <input type="text" class="form-control" name="type" placeholder="type">
            </div>

            <div class="form-group py-2">
                <label for="">Color</label>
                <input type="text" class="form-control" name="color" placeholder="color">
            </div>

            <div class="form-group py-2">
                <label for="">Dimension</label>
                <input type="text" class="form-control" name="dimension" placeholder="dimension">
            </div>

            <div class="form-group py-2">
                <label for="">Other description</label>
                <input type="text" class="form-control" name="other_description" placeholder="other_description">
            </div>

            <div class="form-group py-2">
                <label for="">Model</label>
                <input type="text" class="form-control" name="model" placeholder="model">
            </div>

            <div class="form-group py-2">
                <label for="">Serial Number</label>
                <input type="text" class="form-control" name="serial_number" placeholder="serial_number">
            </div>

            <div class="form-group py-3">
                <label for="one">Product Image:</label> <br>
                <input type="file" name="product_image" class="form-control-file" id="one">
            </div>
            <div class="form-group py-3">
                <button class="btn btn-primary" type="submit">Create</button>
            </div>

        </form>
        </div>

      </div>
    </div>
  </div>



</div>

@endsection
