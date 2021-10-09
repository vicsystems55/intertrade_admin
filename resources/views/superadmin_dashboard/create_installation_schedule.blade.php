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


            @if(Session::has('installation_schedule_msg'))
            <p class="alert alert-info">{{ Session::get('installation_schedule_msg') }}</p>
            @endif

            <h4>Configure Schedule</h4>

            <form action="{{route('create_installation_schedule')}}" class="col-md-6 " method="post">
                
                @csrf 

                <div class="form-group">
                    <label for="">Deployments Zone</label>
                    <select name="deployment_id" id="" class="form-control">
                        <option value="">--Select Deployment Site --</option>

                        @foreach ($deployments as $deployment)

                            <option value="{{$deployment->id}}" title="{{$deployment->facility_name}}">
                              
                                {{$deployment->facility_name}}
                            
                            </option>
                            
                        @endforeach

               
                      
                    </select>
                </div>
           

                <div class="form-group mb-3">
                    <label for="">Select Technician</label>
                    <select name="technician_assigned" id="" class="form-control">
                        <option value="">-- Assign Technician--</option>

                        @foreach ($users as $user)

                            <option value="{{$user->id}}">{{$user->name}}</option>
                            
                        @endforeach
                       
                      
                    </select>
                </div>

                <div class="form-group mb-3">
                    <button class="btn btn-primary col-md-12 btn-block">
                        Create Schedule
                    </button>
                </div>



            </form>


            

        </div>
    </div>
</div>
    
@endsection