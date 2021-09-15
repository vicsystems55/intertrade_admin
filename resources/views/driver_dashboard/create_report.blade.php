@extends('layouts.app')


@section('content')


    <div class="page-content">

        <div class="p-5"></div>

        <h4>Daily Reports</h4>

        @if ($errors->any())
            @foreach ($errors->all() as $error)
                <p class="alert alert-warning">{{$error}}</p>
            @endforeach
        @endif

        @if(Session::has('report_msg'))
        <p class="alert alert-info">{{ Session::get('report_msg') }}</p>
        @endif


         

        <form action="{{route('create_report')}}" method="post">
            @csrf 

            <div class="row">
                <div class="col-md-6">

                    <div class="form-group mb-3">
                        <label for="">Deployment State</label>
                        <select name="state" id="" class="form-control">
                            <option value="">--Select State--</option>

                            @foreach ($deployments as $state)
                                <option value="{{$state->state}}">{{$state->state}}</option>
                            @endforeach


                            
                        </select>
                    </div>

                    <div class="form-group mb-3">
                        <label for="">Site Name:</label>
                        <select name="site_name" id="" class="form-control">
                            <option value="">Select Site</option>
                            
                            @foreach ($deployments as $site)
                                <option value="{{$site->facility_address}}">{{$site->facility_address}}</option>
                            @endforeach


                            
                        </select>
                    </div>

                    <div class="form-group mb-3">
                        <label for="">UCC Model</label>
                        <input type="text" name="model" class="form-control" placeholder="UCC Serial Number">
                    </div>

                    <div class="form-group mb-3">
                        <label for="">Installation Completion Date:</label>
                        <input name="installation_completion_date" type="date" class="form-control" placeholder="Installation Completion Date">
                    </div>

                    <div class="form-group mb-3">
                        <label for="">Number of Units;</label>
                        <input type="number" name="units" class="form-control" placeholder="Number of Units">
                    </div>

                    

                </div>
                <div class="col-md-6">

                    <div class="form-group mb-3">
                        <label for="">UCC Serial Number(s):</label>
                        <input name="ucc_serial_number" type="text" class="form-control" placeholder="UCC Serial Number">
                    </div>

                    <div class="form-group mb-3">
                        <label for="">RTM Number:</label>
                        <input name="rtmd_number" type="text" class="form-control" placeholder="RTM Number">
                    </div>

                    <div class="form-group mb-3">

                        <label for="">Functional State:</label>

                        <input name="functional_state"  type="text" class="form-control" placeholder="Functional State">
                    </div>

                    <div class="form-group mb-3">

                        <label for="">Temperature at Update:</label>
                        <i  title="The temperature at the time of taking this report" class="fadeIn animated bx bx-info-circle"></i>

                        <input name="temp_at_update"  type="text" class="form-control" placeholder="Ambient Temperature">
                    </div>

                    <div class="form-group mb-3">

                        <label for="">Date Submitted:</label>
                        <i  title="" class="fadeIn animated bx bx-info-circle"></i>

                        <input name="date_submitted"  type="date" class="form-control" placeholder="Date submitted">
                    </div>

                    <div class="form-group mb-3">

                        <label for="">Remark:</label>
                        <i  title="Short description to go with this report" class="fadeIn animated bx bx-info-circle"></i>

                        <textarea name="remark" col="10" row="5"  type="text" class="form-control" placeholder="Remark"></textarea>
                    </div>


                </div>
            </div>

        

        <uploader-component appurl="{{config('app.url')}}" reportcode="{{Session::get('report_code')}}"></uploader-component>


        <div class="col-md-6 mx-auto p-5">
            <button type="submit" class="btn btn-primary shadow col-md-10 mx-auto btn-lg">SUBMIT REPORT</button>
        </div>

    </form>




    </div>
    
@endsection