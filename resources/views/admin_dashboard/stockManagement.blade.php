@extends('layouts.app')

@section('content')


<div class="page-content">
    <div class="p-3"></div>
    <h4>Stock Management</h4>
    <div class="row row-cols-1 row-cols-md-2 row-cols-xl-3">
        <div class="col">
        <div class="card radius-10 border-start border-0 border-3 border-info">
            <div class="card-body">
                <div class="d-flex align-items-center">
                    <div>
                        <p class="mb-0 text-secondary">Orders</p>
                        <h4 class="my-1 text-info">{{$orders->count()}}</h4>
                        <p class="mb-0 font-13">+2.5% from last week</p>
                    </div>
                    <div class="widgets-icons-2 rounded-circle bg-gradient-scooter text-white ms-auto"><i class='bx bxs-cart'></i>
                    </div>
                </div>
            </div>
        </div>
        </div>
        <div class="col">
        <div class="card radius-10 border-start border-0 border-3 border-success">
            <div class="card-body">
                <div class="d-flex align-items-center">
                    <div>
                        <p class="mb-0 text-secondary">Total Sales</p>
                        <h4 title="N {{number_format(($total),2)}}" class="my-1 text-success">N {{number_format(($total),2)}} </h4>
                        <p class="mb-0 font-13">-4.5% from last week</p>
                    </div>
                    <div class="widgets-icons-2 rounded-circle bg-gradient-bloody text-white ms-auto"><i class='bx bxs-wallet'></i>
                    </div>
                </div>
            </div>
        </div>
        </div>
        <div class="col ">
            <div class="card radius-10 border-start border-0 border-3 border-success">
                <div class="card-body">
                    <div class="d-flex align-items-center">
                        <div>
                            <p class="mb-0 text-secondary">Total Stock</p>
                            <h4 class="my-1 text-success">N {{ Str::limit(number_format($total_stock, 2), 20)}}</h4>
                            <p class="mb-0 font-13">-4.5% from last week</p>
                        </div>
                        <div class="widgets-icons-2 rounded-circle bg-gradient-ohhappiness text-white ms-auto"><i class='bx bxs-bar-chart-alt-2' ></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col">
            <div class="card radius-10 border-start border-0 border-3 border-warning">
                <div class="card-body">
                    <div class="d-flex align-items-center">
                        <div>
                            <p class="mb-0 text-secondary">Customers</p>
                            <h4 class="my-1 text-warning">{{$customers->count()}}</h4>
                            <p class="mb-0 font-13">+8.4% from last week</p>
                        </div>
                        <div class="widgets-icons-2 rounded-circle bg-gradient-blooker text-white ms-auto"><i class='bx bxs-group'></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div><!--end row-->

    <h6>View List</h6>

    <div class=" py-2 d-flex justify-content-end">
        <button class="btn btn-outline-primary btn-sm float-right">Export PDF</button>
        <button class="btn btn-outline-primary btn-sm float-right">Export EXCEL</button>

    </div>

    <div class="card p-1">
        <div class="row">
            <div class="col-2">
                <h6 class="text-muted">Status</h6>
            </div>
            <div class="col-3">
                <h6 class="text-muted">Products</h6>
            </div>
            <div class="col-2">
                <h6 class="text-muted">In stock</h6>
            </div>
            <div class="col-2">
                <h6 class="text-muted">Unit Price </h6>
            </div>
            <div class="col-2">
                <h6 class="text-muted">Total Price </h6>
            </div>

        </div>
    </div>

    @foreach ($products as $product)

    <div class="py-1">
        <div class="card">
            <div class="card-body">
                <div class="row d-flex align-items-center">
                    <div class="col-2">
                        <img src="{{$product->featured_image}}" style="height: 50px;" alt="">
                    </div>
                    <div class="col-3">
                        <h6>{{$product->name}}</h6>
                        <p>In Stock</p>
                    </div>
                    <div class="col-2">
                        <h6>{{$product->stock->where('type', 'out')->sum('quantity') * (-1)}}/{{$product->stock->where('type', 'in')->sum('quantity')}}</h6>
                    </div>
                    <div class="col-2">
                        <h6>N {{number_format($product->price, 2)}}


                        </h6>
                    </div>

                    <div class="col-2">
                        <h6>

                        N {{number_format($product->stock->sum('quantity') * $product->price, 2)}}
                        </h6>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endforeach

    <div class="py-1">
        <div class="card bg-primary">
            <div class="card-body">
                <div class="row d-flex align-items-center">
                    <div class="col-2">

                    </div>
                    <div class="col-3">

                    </div>
                    <div class="col-2">

                    </div>
                    <div class="col-2">
                        <h6 class="text-white">Total: </h6>
                    </div>

                    <div class="col-2">
                        <h6 class="text-white">

                        N {{number_format($total_stock, 2)}}
                        </h6>
                    </div>
                </div>
            </div>
        </div>
    </div>




    <div class="d-flex justify-content-center py-2">

        <a href="{{route('stockManagement.create')}}" class="btn btn-primary">Add Stock</a>

    </div>





</div>

@endsection
