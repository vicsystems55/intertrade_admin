@extends('layouts.app')


@section('content')


    <div class="page-content">

        <div class="p-2"></div>

        <h6>Cash Request Details</h6>

  


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
                                        <input type="text" class="form-control" name="title" placeholder="Give a title of the request" value="{{$cash_request->title}}">
                                    </div>
                                    <div class="form-group">
                                        <label for="company_name">Amount:</label>
                                        <input type="number" class="form-control" name="amount_requested" placeholder="0.00" value="{{$cash_request->amount_requested}}">
                                    </div>
                                </div>
                                
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="company_name">Description</label>
                                        <textarea name="description" class="form-control" placeholder="Enter detailed description of cash request" cols="30" rows="5">{{$cash_request->description}}"</textarea>
                                    </div>
                                </div>

                            </div>



                      

                        <div class="form-group py-2">
                            <button class="btn btn-success shadow ">
                                Approve
                            </button>

                            <button class="btn btn-danger shadow ">
                                Disaprove
                            </button>
                        </div>
           
                    </form>
                    </div>
                </div>
            </div>

           
        </div>




    </div>
    
@endsection