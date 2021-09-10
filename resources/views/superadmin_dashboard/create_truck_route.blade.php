@extends('layouts.app')



@section('content')


<div class="page-content">
    <div class="p-5"></div>

    <div class="card">
        <div class="card-body">

                   
            @if ($errors->any())
            @foreach ($errors->all() as $error)
                <p class="alert alert-warning">{{$error}}</p>
            @endforeach
            @endif


            @if(Session::has('truck_route_msg'))
            <p class="alert alert-info">{{ Session::get('truck_route_msg') }}</p>
            @endif

            <h4>Configure Truck Route</h4>

            <form action="{{route('create_truck_route')}}" class="col-md-6 " method="post">
                
                @csrf 

                <div class="form-group">
                    <label for="">Deployments Zone</label>
                    <select name="deployment_id" id="" class="form-control">
                        <option value="">--Select Deployment Site --</option>

                        @foreach ($deployments as $deployment)

                            <option value="{{$deployment->id}}" title="{{$deployment->facility_address}}">
                              
                                {{$deployment->deployment_code}}
                            
                            </option>
                            
                        @endforeach

               
                      
                    </select>
                </div>

                <div class="form-group">
                    <label for="">Select Truck</label>
                    <select name="inventory_id" id="" class="form-control">
                        <option value="">--Select Truck --</option>

                        @foreach ($inventories as $inventory)

                            <option value="{{$inventory->id}}">{{$inventory->name}}</option>
                            
                        @endforeach
                       
                      
                    </select>
                </div>

                <div class="form-group mb-3">
                    <label for="">Pick up date:</label>
                    <input type="date" name="pickup_date" class="form-control">
                </div>

                <div class="form-group mb-3">
                    <label for="">Drop off date:</label>
                    <input type="date" name="dropoff_date" class="form-control">
                </div>

                <div class="form-group mb-3">
                    <label for="">Select Driver</label>
                    <select name="driver_assigned" id="" class="form-control">
                        <option value="">-- Assign a driver--</option>

                        @foreach ($users as $user)

                            <option value="{{$user->id}}">{{$user->name}}</option>
                            
                        @endforeach
                       
                      
                    </select>
                </div>

                <div class="form-group mb-3">
                    <button class="btn btn-primary col-md-12 btn-block">
                        Assign
                    </button>
                </div>



            </form>


            

        </div>
    </div>
</div>
    
@endsection