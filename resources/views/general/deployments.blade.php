@extends('layouts.app')


@section('content')


<div class="page-content">
    <div class="p-5"></div>

    <div class="row">
        <div class="col-md-6">
            
            <h4>{{$project->title}}</h4>
            <h6>{{$project->code}}</h6>

            <p>
                {{$project->description}}
            </p>
        </div>
        <div class="col-md-6">

            <a href="{{route('admin.truck_routes')}}" class="btn btn-lg btn-primary col-md-6">
                View Logistic Plan
            </a>

        </div>
    </div>

    <div class="col-md-12">
        <div class="car">
            <h4>Deployments</h4>
            <div class="card-bod">
            

                  


                       @forelse ($deployments as $deployment)
                       <div class="card">
                        <div class="card-body">

                      <table class="table">
                        <tr>
                            <td>State: </td>
                            <td>
                            <span style="font-weight: bold;" class="font-weight-bold">
                                {{$deployment->state}}
                            </span>
                            </td>
                            </tr>
                            <tr>
                            <td>Facility Address: </td>
                            <td>
                            <span style="font-weight: bold;" class="font-weight-bold" title="{{$deployment->facility_name}}">
                                {{$deployment->facility_address}}
                            </span>
                            </td>
                            </tr>
                           
                           
                            <tr>
                            <td>Contact Number: </td>
                            <td>
                            <span style="font-weight: bold;" class="font-weight-bold" title="{{$deployment->contact_email}}">
                                {{$deployment->contact_number}}
                            </span>
                            </td>
                            </tr>
                           
                            <tr>
                            <td>Number of UCCs: </td>
                            <td>
                            <span style="font-weight: bold;" class="font-weight-bold">
                                {{$deployment->no_ucc}}
                            </span>
                            </td>
                            </tr>

                            <tr>
                                <td>Delivery Status: </td>
                                <td>
                                <span style="font-weight: bold;" class="font-weight-bold badge rounded-pill bg-warning text-dark">
                                    {{$deployment->status}}
                                </span>
                                </td>
                                </tr>
                      </table>
                            
                            
                        </div>
                    </div>
                           
                       @empty

                        <h6>No Delivery data...</h6>
                           
                       @endforelse

                  
            </div>
        </div>
    </div>


    


</div>
    
@endsection