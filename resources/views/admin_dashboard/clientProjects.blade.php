@extends('layouts.app')

@section('content')


<div class="page-content">
    <div class="p-3"></div>
    <h4>Projects</h4>

    <div class="container-fluid">

        <div class="row">

            @forelse ($clientProjects as $project)
            <div class="col-md-4 ">
                <div style="height: 125px" class="card ">
                    <div class="card-body">
                        <div class="d-flex justify-content-between">
                            <div class="">
                                <h6>{{$project->title}}</h6>
    
                            </div>
                            <div class="">
                                <span class="badge bg-primary rounded-pill">{{$project->status}}</span>
    
                            </div>
    
                        </div>
                        <a href="{{route('clientProjects.show', $project->id)}}" class="btn btn-sm btn-primary mt-4 shadow" >view details</a>
                    </div>
                </div>
            </div>

            @empty 

            <h6 class="py-5 text-center">No projects yet.</h6>
                
            @endforelse
    
            
    
           
        </div>
    </div>

    <div class="container">
        
        <div class="card">
            <div class="card-body">
                @if(Session::has('msg'))
            <p class="alert alert-info">{{ Session::get('msg') }}</p>
            @endif

                <form action="{{route('clientProjects.store')}}" method="post" class="col-md-6">
                    @csrf
                    <div class="form-group py-1">
                        <label for="title">Title</label>
                        <input type="text" name="title" class="form-control">
                    </div>
                    <div class="form-group py-1">
                        <label for="description">Description</label>
                        <input type="text" name="description" class="form-control">
                    </div>
                    <div class="form-group py-1">
                        <label for="">Select Customer</label>
                       <select name="customer_id" id="" class="form-control">
                        @foreach ($customers as $customer)
                        <option value="{{$customer->id}}">{{$customer->company_name}}</option>
                            
                        @endforeach
                       </select>
                    </div>
                    <div class="form-group py-1 text-center">
                        <a href="" class="btn btn-primary p-1 text-center">+ Add</a>
                    </div>
                    <div class="form-group py-1">
                        <label for="start_date">Scheduled Date</label>
                        <input type="date" name="start_date" class="form-control">
                    </div>
                    <div class="form-group py-1">
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>





 


   
</div>
    
@endsection