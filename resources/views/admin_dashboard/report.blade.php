@extends('layouts.app')


@section('content')

    <div class="page-content card">
        <div class="p-5"></div>

        <h6>{{$report->state}}</h6>
        <h4>{{$report->site_name}}</h4>

        {{-- <h4>Report</h4> --}}

        <table class="table table-striped">
            <thead>
                <tr>
                    <td>
                        Report By: 
                    </td>
                    <th>
                        {{$report->reporters->name}}
                    </th>
                </tr>
                <tr>
                    <td>
                        Model: 
                    </td>
                    <th>
                        {{$report->model}}
                    </th>
                </tr>
                <tr>
                    <td>
                        Installation Completion Date: 
                    </td>
                    <th>
                        {{$report->installation_completion_date}}
                    </th>
                </tr>
                <tr>
                    <td>
                        UCC Serial Number(s): 
                    </td>
                    <th>
                        {{$report->ucc_serial_number}}
                    </th>
                </tr>
                <tr>
                    <td>
                        RTM Number: 
                    </td>
                    <th>
                        {{$report->rtmd_number}}
                    </th>
                </tr>
                <tr>
                    <td>
                        Functional State: 
                    </td>
                    <th>
                        {{$report->functional_state}}
                    </th>
                </tr>
                <tr>
                    <td>
                        Temperature at Update: 
                    </td>
                    <th>
                        {{$report->temp_at_update}}
                    </th>
                </tr>
                <tr>
                    <td>
                        Date Submitted: 
                    </td>
                    <th>
                        {{$report->date_submitted}}
                    </th>
                </tr>
                <tr>
                    <td>
                        Number of units: 
                    </td>
                    <th>
                        {{$report->units}}
                    </th>
                </tr>
                <tr>
                    <td>
                        Remark: 
                    </td>
                    <th>
                        {{$report->remark}}
                    </th>
                </tr>
                <tr>
                    <td>
                        status: 
                    </td>
                    <th>
                        {{$report->status}}
                    </th>
                </tr>
                <tr>
                </tr>
            </thead>
        </table>


        <div class="mt-3">

            <div class="row">

                    
            @foreach ($report->report_images as $image)

                <div class="col-md-4 ext-center">

                    <img style="height: 200px; object-fit: cover;" src="{{config('app.url')}}{{$image->img_path}}" alt="">


                </div>


                
            @endforeach

            </div>





        </div>

    </div>


    









    
@endsection