@extends('layouts.app')


@section('content')


<div class="page-content">
    <div class="p-5"></div>

    <h4>Deployment: </h4>


    <div class="card">
        <div class="card-body text-center">
            <a href="{{route('superadmin.create_deployment')}}" class="btn btn-primary btn-lg shadow ">
                CREATE DEPLOYMENT
            </a>
        </div>
    </div>
</div>
    
@endsection