@extends('layouts.app')


@section('content')


<div class="page-content">
    <div class="p-5"></div>


    <h4>{{$project->title}}</h4>
    <h6>{{$project->code}}</h6>

    <p>
        {{$project->description}}
    </p>

    <div class="col-md-12">
        <div class="card">
            <h4>Deliveries</h4>
            <div class="card-body">
                <table class="table">

                    <thead>

                        <tr>
                            <th>#</th>
                            <th>Site Type</th>
                            <th>State</th>
                            <th>District</th>
                            <th>Facility Address</th>
                            <th>Facility Name</th>
                            <th>Closet Town</th>
                            <th>OIC</th>
                            <th>Contact Number</th>
                            <th>Contact Email</th>
                            <th>No of UCCs</th>
                            <th>Accessibility By Road</th>
                            <th>Distance From Ware House</th>
                            <th>Quality of road</th>
                        </tr>

                    </thead>

                    <tbody>

                       @forelse ($deliveries as $delivery)

                       <tr>
                        <th>{{$loop->iteration}}</th>
                        <th>{{$project->site_type}}</th>
                        <th>{{$project->state}}</th>
                        <th>{{$project->district}}</th>
                        <th>{{$prpject->facility_address}}</th>
                        <th>{{$project->facility_name}}</th>
                        <th>{{$project->closet_town}}</th>
                        <th>{{$project_OIC}}</th>
                        
                        <th>{{$project->contact_number}}</th>
                        <th>{{$project->contact_email}}</th>
                        <th>{{$project->no_ucc}}</th>
                        <th>{{$project->road_access}}</th>
                        <th>{{$project->ware_house_distance}}</th>
                        <th>{{$project->road_quality}}</th>
                    </tr>
                           
                       @empty

                        <h6>No Delivery data...</h6>
                           
                       @endforelse

                    </tbody>
                    
                </table>
            </div>
        </div>
    </div>


    


</div>
    
@endsection