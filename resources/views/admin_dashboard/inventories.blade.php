@extends('layouts.app')

@section('content')


<div class="page-content">
    <div class="p-5"></div>
    <h4>Inventory</h4>



 


    @foreach ($inventories as $inventory)

        <div class="card mb-3 shadow">
            <div class="card-body">

                <div class="row">
                    <div class="col-3">

                        <img style="height: 90px;" src="{{config('app.url')}}inventory_images/{{$inventory->image}}" alt="">
            
                    </div>
                    <div class="col-7">

                        <h6>{{$inventory->name}}</h6>
                        <p>{{$inventory->description}}</p>

            
                    </div>
                </div>
                
            </div>
        </div>

        
    @endforeach
</div>
    
@endsection