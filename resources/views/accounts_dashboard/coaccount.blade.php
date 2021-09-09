@extends('layouts.app')


@section('content')

    <div class="page-content">

        <div class="p-5"></div>

      

           <example-component appurl="{{config('app.url')}}"></example-component>

        <div class="row mt-5 ">

            <div class="col-md-6">
                <div class="card">
                    <div class="card-body">
                        <h4>Create Account Heads</h4>
                        <form action="" method="post">
                            @csrf
                            <div class="form-group mb-3">
                                <label for="">Title</label>
                                <input type="text" class="form-control" placeholder="Enter Account Head Title">
                            </div>
                            <div class="form-group mb-3">
                                <button class="btn btn-primary">
                                    Submit
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="card">
                    <div class="card-body">
                        <h4>Create Account Subheads</h4>
                        <form action="" method="post">
                            @csrf
                            <div class="form-group mb-3">
                                <label for="">Title</label>
                                <input type="text" class="form-control" placeholder="Enter Account Sub title">
                            </div>
                            <div class="form-group mb-3">
                                <button class="btn btn-primary">
                                    Submit
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

            <div class="col-md-6">
                <div class="card">
                    <div class="card-body">

                        @if(Session::has('map_msg'))
                        <p class="alert alert-info">{{ Session::get('map_msg') }}</p>
                        @endif

    
    
                        <form action="{{route('map_account')}}" method="post">
                            @csrf
                            <div class="form-group mb-3">
                                <label for="">Account Heads</label>
                                <select class="form-control" name="account_heads_id" id="" placeholder="Select Head of Accounts">

                                    @foreach ($account_heads as $head)
                                    
                                   
                                    <option value="{{$head->id}}">{{$head->title}}</option>
                                        
                                    @endforeach
    
                                   
    
                                </select>
                            </div>
    
                            <div class="form-group mb-3">
                                <label for="">Account Sub Heads</label>
                                <select name=" account_sub_head_id" id="" class="form-control" placeholder="Select Sub Heads">
    
                                    @foreach ($account_sub_heads as $sub_head)

                                    <option value="{{$sub_head->id}}">{{$sub_head->title}}</option>
                                        
                                    @endforeach
    
                                </select>
                            </div>

                            <div class="form-group mb-3">
                                <button class="btn btn-block btn-primary">
                                    Create
                                </button>
                            </div>


                        </form>
    
    
    
                    </div>
                </div>
            </div>


            <div class="col-md-6">
                <div class="card">
                    <div class="card-body">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>Head</th>
                                    <th>Sub Head</th>
                                    <th>Description</th>
                                </tr>
                            </thead>

                            <tbody>

                                @forelse ($account_mapings as $maping)

                                <tr>
                                    <td>{{$maping->heads->title}}</td>
                                    <td>{{$maping->subheads->title}}</td>
                                    <td></td>
                                </tr>
                                    
                                @empty
                                    
                                @endforelse
                                
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
@endsection