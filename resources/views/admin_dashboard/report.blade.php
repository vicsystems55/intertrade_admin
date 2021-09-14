@extends('layouts.app')


@section('content')

    <div class="page-content card">
        <div class="p-5"></div>

        <h6>{{$report->state}}</h6>
        <h4>{{$report->site_name}}</h4>

        <h4>Report</h4>

        <table class="table table-striped">
            <thead>
                <tr>
                    <td>
                        model: 
                    </td>
                    <th>
                        {{$report->model}}
                    </th>
                </tr>
                <tr>
                    <td>
                        installation_completion_date: 
                    </td>
                    <th>
                        {{$report->installation_completion_date}}
                    </th>
                </tr>
                <tr>
                    <td>
                        ucc_serial_number: 
                    </td>
                    <th>
                        {{$report->ucc_serial_number}}
                    </th>
                </tr>
                <tr>
                    <td>
                        rtmd_number: 
                    </td>
                    <th>
                        {{$report->rtmd_number}}
                    </th>
                </tr>
                <tr>
                    <td>
                        functional_state: 
                    </td>
                    <th>
                        {{$report->functional_state}}
                    </th>
                </tr>
                <tr>
                    <td>
                        temp_at_update: 
                    </td>
                    <th>
                        {{$report->temp_at_update}}
                    </th>
                </tr>
                <tr>
                    <td>
                        date_submitted: 
                    </td>
                    <th>
                        {{$report->date_submitted}}
                    </th>
                </tr>
                <tr>
                    <td>
                        units: 
                    </td>
                    <th>
                        {{$report->units}}
                    </th>
                </tr>
                <tr>
                    <td>
                        remark: 
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