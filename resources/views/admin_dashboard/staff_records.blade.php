@extends('layouts.app')


@section('content')


    <div class="page-content">

        <div class="p-5"></div>

        <h4>Staff Records</h4>


        <div class="card mb-3">
            <div class="card-body">
                <div class="form-group">
                    <label for="">Search</label>
                    <input type="text" class="form-control">
                
                </div>
            </div>
        </div>

        <div class="card">
            <div class="card-body">


                <table class="table table-striped table-hover">
                    <thead>
                        <th>#</th>
                        <th>Fullname</th>
                        <th>Email</th>
                        <th>Designation</th>
                    </thead>


                    <tbody>


                        @forelse ($users as $user)

                            <tr>
                                <td>{{$user->name}}</td>
                                <td>{{$user->email}}</td>
                                <td>{{$user->role}}</td>
                                <td>
                                    <button class="btn btn-primary btn-sm shadow">Details</button>
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