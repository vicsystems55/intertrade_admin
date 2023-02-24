@extends('layouts.app')


@section('content')


    <div class="page-content">

        <div class="p-3"></div>

        <h6>Customer Register</h6>


        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">

                        @if ($errors->any())
                            @foreach ($errors->all() as $error)
                                <p class="alert alert-warning">{{$error}}</p>
                            @endforeach
                        @endif

                        
                        @if(Session::has('cusMsg'))
                        <p class="alert alert-info">{{ Session::get('cusMsg') }}</p>
                        @endif


                        <form action="{{route('customers.store')}}" method="post">
                            @csrf

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="company_name">Company Name:</label>
                                        <input type="text" class="form-control" name="company_name">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="state">State</label>
                                        <input type="text" class="form-control" name="state">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="contact_person_name">Contact Person Name</label>
                                        <input type="text" class="form-control" name="contact_person_name">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="contact_person_phone">Contact Person Phone</label>
                                        <input type="text" class="form-control" name="contact_person_phone">
                                    </div>
                                </div>
                        
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="contact_person_address">Contact Person Address</label>
                                        <input type="text" class="form-control" name="contact_person_address">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="category">Category</label>
                                        <input type="text" class="form-control" name="category">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="business_email">Business Email</label>
                                        <input type="text" class="form-control" name="business_email">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="business_phone1">Phone 1</label>
                                        <input type="text" class="form-control" name="business_phone1">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="business_phone2">Phone 2</label>
                                        <input type="text" class="form-control" name="business_phone2">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="business_phone3">Phone 3</label>
                                        <input type="text" class="form-control" name="business_phone3">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="address">Address</label>
                                        <input type="text" class="form-control" name="address">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="location_coordinates">Location Coordinates</label>
                                        <input type="text" class="form-control" name="location_coordinates">
                                    </div>
                                </div>
                            </div>



                      

                        <div class="form-group py-2">
                            <button class="btn btn-primary shadow ">
                                Create Customer
                            </button>
                        </div>
           
                    </form>
                    </div>
                </div>
            </div>

            <div class="col-md-12">
                <div class="row">

                    @foreach ($customers as $customer)
                    <div class="col-md-3">

                   

                        <div class="card">
                            <div class="card-body">
                                <h6>{{$customer->contact_person_name}}</h6>
                                <p>{{$customer->contact_person_address}}</p>
                                <p>{{$customer->contact_person_phone}}</p>


        
                            </div>
                        </div>
                        
                    </div>
                            
                    @endforeach
                    
                </div>
            </div>
        </div>




    </div>
    
@endsection