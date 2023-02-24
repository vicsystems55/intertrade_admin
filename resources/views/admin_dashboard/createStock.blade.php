@extends('layouts.app')

@section('content')


<div class="page-content">
    <div class="p-3"></div>
    <h4> Add Stock</h4>

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
                    </select>
                </div>

                <div class="py-2">
                    <label for="supplier">Supplier</label>
                    <select name="supplier_id" id="" class="form-control">
                        <option value="1">Haier Biomedical</option>
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
                        @foreach ($users as $user)
                        <option value="{{$user->id}}">{{$user->name}}</option>
                            
                        @endforeach
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
                            <th>Received By</th>
                            <th>Date Received</th>
                        </tr>
                    </thead>

                    <tbody>
                        @foreach ($stocks->where('type', 'in') as $stock)
                        <tr>
                            <td>{{$loop->iteration}}</td>
                            <td>{{$stock->product->name}}</td>
                            <td>{{$stock->quantity}}</td>
                            <td>
                                
                                <img style="height: 20px;" src="{{$stock->receiver->avatar}}" alt="">
                                {{$stock->receiver->name??''}}</td>
                            <td>{{\Carbon\Carbon::parse($stock->date_received)->diffForHumans()}}</td>
                        </tr>
                            
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>



  

 
   
</div>
    
@endsection
