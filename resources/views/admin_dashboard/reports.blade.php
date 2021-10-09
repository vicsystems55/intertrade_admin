@extends('layouts.app')


@section('content')

    <div class="page-content">
        <div class="p-5"></div>

        <h4>Daily Reports</h4>

       <div class="card table-responsive">
           <div class="card-body">
            <table class="table table-striped table-hover">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Drivers Name</th>
                        <th>Report Type</th>
                        <th>State</th>
                        
                        <th>Facility</th>
                       
                        <th>Unit</th>
                        <th>Status</th>
                        <th>Serial Number</th>
                        <th>Date Submitted</th>
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
                            {{$report->reporters->name}}
                        </td>
                        <td>
                            {{$report->report_type??'Deployment Report'}}
                        </td>

                       
                        <td>
                            <span>
                                {{$report->state}}
                            </span>
                        </td>

                      
                        <td>
                            <span>
                                {{$report->site_name}}
                            </span>
    
                        </td>
    
                        <td>
                            <span class="">
                                {{$report->units}}
                            </span>
                        </td>

                        <td>
                            <span style="font-weight: bold;" class="font-weight-bold badge rounded-pill bg-{{$report->status=='submitted'?'success':'warning'}} text-dark">
                                {{$report->status}}
                            </span>
                        </td>

                        <td style="word-wrap: break-word;" >
                            <span style=" word-wrap: break-word; height: 300px;">
                                {{substr($report->ucc_serial_number,0,30).'...'}}
                            </span>
                        </td>
                        <td>
                            <span>
                                {{\Carbon\Carbon::parse($report->date_submitted)->format('d M, Y')}}
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