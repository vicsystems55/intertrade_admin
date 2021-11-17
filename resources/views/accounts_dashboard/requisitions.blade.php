@extends('layouts.app')


@section('content')


    <div class="page-content">

        <div class="p-5"></div>

        <h4>Requisitions.</h4>

        <div class="row">
            <div class="col-md-5 mx-auto">
                <div class="card">
                    <div class="card-body text-center">
                        <h4>Total Request</h4>
                        <h6>0</h6>
                    </div>
                </div>
            </div>
            <div class="col-md-5 mx-auto">
                <div class="card">
                    <div class="card-body text-center">
                        <h4>Total Approved</h4>
                        <h6>0</h6>
                    </div>
                </div>
            </div>
         
        </div>


        {{-- <div class="c py-5 text-center">
            <a href="{{route('accounts.create_requisition')}}" class="btn btn-primary">Create New Requisition</a>
        </div> --}}
            @include('general.requisition_form')

        <div class="card mb-3">
            <div class="card-body">
                <div class="row">
                    <div class="col-md-6">
                        <label for="">Search</label>
                        <input type="text" class="form-control ">

                    </div>
                    <div class="col-md-6">

                        <div class="form-group">
                            <label for=""></label>
                            <button class="btn btn-primary mt-3">Search</button>
                        </div>

                    </div>
                </div>
                <div class="form-group">
                   
                
                </div>
            </div>
        </div>

        <div class="card">
            <div class="card-body">


                <table class="table table-striped table-hover">
                    <thead>
                        <th>#</th>
                        <th>Department</th>
                        <th>Request By</th>
                        <th>Request Amount</th>
                        <th>Date Submitted</th>
                        <th>Status</th>
                    </thead>


                    <tbody>
{{Auth::user()->id}}

                        @forelse ($requisitions as $requisition)
                       
                            <tr>
                                <td>{{$loop->iteration}}</td>
                                <td>{{$requisition->department}}</td>
                                <td>{{$requisition->users->name}}</td>
                                <td>{{$requisition->amount_requested}}</td>
                                <td>{{$requisition->created_at}}</td>
                                <td>{{$requisition->status}}</td>
                                <td>
                                    <a href="{{url('accounts/requisition/', $requisition->id)}}" class="btn btn-warning btn-sm shadow">Details</a>
                                </td>
                            </tr>


                            
                        @empty

                        <tr>
                            <td></td>
                            <td>
                                <h4>No record yet...</h4>
                            </td>
                            <td></td>
                            <td></td>
                        </tr>
                            
                        @endforelse


                       

                    </tbody>
                </table>

                <div class="p-3">
                    
                </div>
            </div>
        </div>


        

    </div>
    
@endsection