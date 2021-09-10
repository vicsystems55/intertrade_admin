@extends('layouts.app')


@section('content')


<div class="page-content">
    <div class="p-5"></div>


    <h4>All Projects</h4>

    <div class="card">
        <div class="card-body">

            <div class="form-group mb-3 col-md-6 ">
                <label for="">Search</label>
                <input type="text" class="form-control" placeholder="Search for item">
            </div>
            <div class="form-group mb-3 col-md-6 ">
                <button style="float: right" class="btn btn-primary shadow">Search</button>
            </div>
        </div>
    </div>


    <div class="row">


        @forelse ($projects as $project)

        <div class="col-md-12">
            <div  class="card shadow">

                <div style="max-height: 150px;" class="card-body">

                <div class="row">
                    <div class="col-md-2">

                        <img style="height: 100px;" src="{{$project->featured_img}}" alt="">

                    </div>
                    <div class="col-md-7">

                        <h4>{{$project->title}}</h4>
                    <p>
                        {{$project->description}}
                    </p>

                    </div>
                    <div class="col-md-3">
                        

                        <a href="{{route('admin.project', $project->id)}}" class="btn btn-primary mt-3 col-md-12 shadow">View Deployment Points</a>


                    </div>
                </div>
              
            
                    

                   
                </div>
                
            </div>
        </div>
            
        @empty
            
        @endforelse



    </div>


</div>
    
@endsection