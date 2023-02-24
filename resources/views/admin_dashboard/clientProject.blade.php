@extends('layouts.app')

@section('content')


<div class="page-content">
    <div class="p-3"></div>
    <h4>Project: {{$clientProject->title}}</h4>

    <h6>Milestones</h6>

 

 

    <div class="accordion" id="accordionExample">

        @forelse ($clientProject->milestones as $milestone)

        <div class="card">
            <div class="card-header" id="headingOne{{$milestone->id}}">
              <h2 class="mb-0">
                <button class="btn btn-lin btn-block " type="button" data-toggle="collapse" data-target="#collapseOne{{$milestone->id}}" aria-expanded="true" aria-controls="collapseOne{{$milestone->id}}">
                  {{$loop->iteration}} {{$milestone->title}}
                </button>
              </h2>
              <p style="margin-left: 23px;" class=""><b>{{$milestone->description}}</b></p>
            </div>
        
            <div id="collapseOne{{$milestone->id}}" class="collapse {{$loop->first?'show':''}}" aria-labelledby="headingOne{{$milestone->id}}" data-parent="#accordionExample">
              <div class="card-body">

                <h6>Reports</h6>

                <div style="background-color: lightgrey;" class="card mb-3 p-2 ">
                    <textarea name="description" class="form-control" id="" rows="5">{{$milestone->description}}</textarea>
                    
    
                    <div class="container-fluid">
    
                        <h6 class="py-3">Media</h6>
                        <div class="row">
                            <div class="col-md-3 mb-2">
                                <img style="height: 100px;" class="" src="{{url('/assetsx')}}/img/map@2x.png" alt="">
                                <p class="py-1">
                                    <input type="text" class="form-control" value="Lorem ipsum dolor sit, am Harum exceptur">
                                </p>
                                <button class="btn btn-secondary">update</button>
                            </div>

                            <div class="col-md-3 mb-2">
                                <img style="height: 100px;" class="shadow" src="{{url('/assetsx')}}/img/map@2x.png" alt="">
                                <p class="py-1">
                                    <input type="text" class="form-control shadow" value="" placeholder="Add description">
                                </p>
                                <button class="btn btn-primary shadow">new upload</button>
                            </div>
    
                            
    
                            
    
                        </div>
                        
                    </div>

                </div>

                <div style="background-color: lightgrey;" class="card mb-3 p-2 ">
                    <textarea name="description" class="form-control" id="" rows="5">{{$milestone->description}}</textarea>
                    
    
                    <div class="container-fluid">
    
                        <h6 class="py-3">Media</h6>
                        <div class="row">
                            <div class="col-md-3 mb-2">
                                <img style="height: 100px;" class="" src="{{url('/assetsx')}}/img/map@2x.png" alt="">
                                <p class="py-1">
                                    <input type="text" class="form-control" value="Lorem ipsum dolor sit, am Harum exceptur">
                                </p>
                                <button class="btn btn-secondary">update</button>
                            </div>

                            <div class="col-md-3 mb-2">
                                <img style="height: 100px;" class="shadow" src="{{url('/assetsx')}}/img/map@2x.png" alt="">
                                <p class="py-1">
                                    <input type="text" class="form-control shadow" value="" placeholder="Add description">
                                </p>
                                <button class="btn btn-primary shadow">new upload</button>
                            </div>
    
                            
    
                            
    
                        </div>
                        
                    </div>

                </div>

                <hr class="container">



              </div>
            </div>
          </div>

        @empty
    
        <h6 class="text-center py-5">No Milestones yet.</h6>
            
    
    
       
        @endforelse
     
     
      </div>
        


    <div class="card col-md-6">
        <div class="card-body">

            
            <form action="{{route('projectMilestones.store')}}" method="post">
            @csrf
            <input type="hidden" name="client_project_id" value="{{$clientProject->id}}">

            <div class="form-group py-2">
                <label for="title">Title</label>
                <input type="text" class="form-control" name="title">
            </div>

            <div class="form-group py-2">
                <label for="description">Description</label>
                <input type="text" class="form-control" name="description">
            </div>

            <div class="form-group py-2">
                <label for="description">Due date:</label>
                <input type="date" class="form-control" name="due_date">
            </div>

            <div class="form-group py-2">
                <button type="submit" class="btn btn-primary">Create Milestone</button>
            </div>


            </form>
        </div>
    </div>


    



 


   
</div>
    
@endsection

