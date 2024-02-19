@extends('layouts.app')


@section('content')


    <div class="page-content">

        <div class="p-2"></div>

        <h4>Cash Request Details</h4>
        <hr>




        <div class="row">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-body">

                        @if ($errors->any())
                            @foreach ($errors->all() as $error)
                                <p class="alert alert-warning">{{$error}}</p>
                            @endforeach
                        @endif


                        @if(Session::has('cashAppMsg'))
                        <p class="alert alert-info">{{ Session::get('cashAppMsg') }}</p>
                        @endif


                        <form action="{{route('cash_request.approve')}}" method="post">
                            @csrf

                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="company_name">Title:</label>
                                        <input type="hidden" name="cash_request_id" value="{{$cash_request->id}}">
                                        <input type="text" class="form-control" name="title" placeholder="Give a title of the request" value="{{$cash_request->title}}">
                                    </div>
                                    <div class="form-group">
                                        <label for="company_name">Amount:</label>
                                        <input type="number" class="form-control" name="amount_approved" placeholder="0.00" value="{{$cash_request->amount_requested}}">
                                    </div>

                                    <div class="form-group">
                                        <label for="company_name">Description</label>
                                        <textarea name="description" class="form-control" placeholder="Enter detailed description of cash request" cols="30" rows="5">{{$cash_request->description}}"</textarea>
                                    </div>
                                </div>

                                <div class="col-md-6">

                                </div>

                            </div>


                        @if (Auth::user()->role == 'superadmin')
                        <div class="form-group py-3">
                            <input type="submit" value="Approved" name="status" class="btn btn-success col-md-12 shadow " >

                        </div>
                        <div class="form-group py-2">
                            <input type="submit" value="Disapproved" name="status" class="btn btn-danger col-md-12 shadow " >

                        </div>

                        @else

                        @endif



                    </form>
                    </div>
                </div>
            </div>


        </div>




    </div>

@endsection
