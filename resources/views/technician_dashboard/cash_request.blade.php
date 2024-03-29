@extends('layouts.app')


@section('content')


    <div class="page-content">

        <div class="p-2"></div>

        <h4>My Cash Request</h4>

        <hr>

        <div class="row">
            <div class="col-md-4">
                <div class="card">
                    <div class="card-body">
                        <h6>Total Amount Requested</h6>
                        <h4>N {{number_format($cash_requests->where('status', 'pending')->sum('amount_requested'),2)}}</h4>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card">
                    <div class="card-body ">
                        <h6>Total Amount Approved</h6>
                        <h4 class="text-success">N {{number_format($cash_requests->where('status', 'approved')->sum('amount_requested'),2)}}</h4>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card">
                    <div class="card-body">
                        <h6>Total Amount Refunded</h6>
                        <h4 class="text-danger">N {{number_format($cash_requests->where('status', 'refunded')->sum('amount_requested'),2)}}</h4>
                    </div>
                </div>
            </div>
        </div>



        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">

                        @if ($errors->any())
                            @foreach ($errors->all() as $error)
                                <p class="alert alert-warning">{{$error}}</p>
                            @endforeach
                        @endif


                        @if(Session::has('cashMsg'))
                        <p class="alert alert-info">{{ Session::get('cashMsg') }}</p>
                        @endif


                        <form action="{{route('cash_request.store')}}" method="post">
                            @csrf

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="company_name">Title:</label>
                                        <input type="text" class="form-control" name="title" placeholder="Give a title of the request">
                                    </div>
                                    <div class="form-group">
                                        <label for="company_name">Amount:</label>
                                        <input type="number" class="form-control" name="amount_requested" placeholder="0.00">
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="company_name">Description</label>
                                        <textarea name="description" class="form-control" placeholder="Enter detailed description of cash request" cols="30" rows="5"></textarea>
                                    </div>
                                </div>

                            </div>





                        <div class="form-group col-md-6 ">
                            <button class="btn btn-primary float-right shadow ">
                                Submit
                            </button>
                        </div>

                    </form>
                    </div>
                </div>
            </div>

            <h4 class="py-2">Request History</h4>
            <hr>
            <div class="col-md-12">
                <div class="row">

                    @foreach ($cash_requests as $cash_request)
                    <div class="col-md-3">



                        <div style="height: 230px" class="card">
                            <div class="card-header">
                                <h6>{{$cash_request->title}}</h6>

                            </div>
                            <div class="card-body">

                                <p>{{$cash_request->description}}</p>
                                @if ($cash_request->status == 'pending')
                                <span class="badge rounded-pill bg-primary">{{$cash_request->status}}</span>
                                @elseif($cash_request->status == 'Approved')
                                <span class="badge rounded-pill bg-success">{{$cash_request->status}}</span>
                                @elseif($cash_request->status == 'Disapproved')
                                <span class="badge rounded-pill bg-danger">{{$cash_request->status}}</span>

                                @endif

                                <h6>N {{number_format($cash_request->amount_requested,2)}}</h6>




                                <a href="{{route('cash_request_details', $cash_request->id)}}" class="btn btn-info p-1">view details</a>
                            </div>
                            <div class="card-footer">
                                <span class=""><b><i>by: {{$cash_request->requestby->name}}</i></b></span>

                            </div>
                        </div>

                    </div>

                    @endforeach

                </div>
            </div>
        </div>




    </div>

@endsection
