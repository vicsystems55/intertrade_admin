@extends('layouts.app')


@section('content')

    <div class="page-content">
        <div class="p-5"></div>

        <h4>Daily Reports</h4>

       <div class="card">
           <div class="card-body">
            <table class="table">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>State</th>
                        <th>Site Name</th>
                        <th>Model</th>
                        <th>Unit</th>
                        <th></th>
                        <th></th>
                    </tr>
                </thead>
    
                <tbody>
                    @foreach ($reports as $report)
    
                    <tr>
                        <td>
                            {{$loop->iteration}}
    
                        </td>
                        <td>
                            <span>
                                {{$report->state}}
                            </span>
                        </td>
                        <td>
                            <span>
                                {{$report->site}}
                            </span>
    
                        </td>
                        <td>
                            <span>
                                {{$report->model}}
                            </span>
                        </td>
    
                        <td>
                            <span class="badge pill">
                                {{$report->status}}
                            </span>
                        </td>
                        <td>
                            <a href="{{route('admin.report', $report->id)}}" class="btn btn-primary btn-sm shadow">view details</a>
                        </td>
                    </tr>
                        
                    @endforeach
                    
                </tbody>
            </table>
           </div>
       </div>

    </div>

    
@endsection