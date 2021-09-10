@extends('layouts.app')


@section('content')


<div class="page-content">
    <div class="p-5"></div>


    <h4>All Projects</h4>


    <div class="row">


        @forelse ($projects as $project)

        <div class="col-md-4">
            <div style="height: 340px;" class="card shadow">
                <div class="card-body">
                    <h4>{{$project->title}}</h4>
                    <p>
                        {{$project->description}}
                    </p>

                    <div class="card-footer">
                        <a href="{{route('admin.project', $project->id)}}" class="btn btn-primary btn-sm shadow">
                            view
                        </a>
                    </div>
                </div>
            </div>
        </div>
            
        @empty
            
        @endforelse



    </div>


</div>
    
@endsection