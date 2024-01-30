@extends('layouts.app')


@section('content')


    <div class="page-content">

        <div class="p-5"></div>


        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col-md-6">


                        <table class="table table-striped table-hover">

                            <tr>
                                <td>
                                    <span>FULL NAME:</span>
                                </td>
                                <td>
                                    <span style="font-weight: bold;" class="font-weight-bold">{{$user->name}}</span>
                                </td>
                            </tr>

                            <tr>
                                <td>
                                    <span>EMAIL:</span>
                                </td>
                                <td>
                                    <span style="font-weight: bold;" class="font-weight-bold">{{$user->email}}</span>
                                </td>
                            </tr>




                        </table>





                    </div>

                    <div class="col-md-6 text-center">

                        <div class="c mb-3">
                            <img style="height: 100px;  width:100px;" src="{{asset('storage')}}/{{$user->avatar}}" style="object-fit: cover;" alt="" class="shadow rounded rounded-circle img-thumbnail">
                        </div>
                        <div style="font-weight: bold;" class=" mb-3">
                            {{$user->user_code}}
                        </div>

                        <div class="c mb-3 d-none">

                                <button class="btn btn-primary">Deativate?</button>

                        </div>

                        <div class="c mb-3 d-none">

                            <button class="btn btn-primary">Change Priviledge?</button>

                    </div>


                    </div>
                </div>
            </div>
        </div>

        @if ($user->employee_data)

                <div class="card">
                    <div class="card-body">

                        <table class="table table-striped">

                            <tr>
                                <td style="width: 230px;">Surname:</td>
                                <td>
                                    <span style="font-weight: bold">
                                    {{$user->employee_data->surname}}</td>
                                    </span>
                            </tr>
                            <tr>
                                <td style="width: 230px;">First Name:</td>
                                <td>
                                    <span style="font-weight: bold">
                                    {{$user->employee_data->first_name}}</td>
                                    </span>
                            </tr>
                            <tr>
                                <td style="width: 230px;">Middle Name:</td>
                                <td>
                                    <span style="font-weight: bold">
                                    {{$user->employee_data->middle_name}}</td>
                                    </span>
                            </tr>
                            <tr>
                                <td style="width: 230px;">State:</td>
                                <td>
                                    <span style="font-weight: bold">
                                    {{$user->employee_data->state}}</td>
                                    </span>
                            </tr>
                            <tr>
                                <td style="width: 230px;">LGA:</td>
                                <td>
                                    <span style="font-weight: bold">
                                    {{$user->employee_data->lga}}</td>
                                    </span>
                            </tr>
                            <tr>
                                <td style="width: 230px;">Gender:</td>
                                <td>
                                    <span style="font-weight: bold">
                                    {{$user->employee_data->gender}}</td>
                                    </span>
                            </tr>
                            <tr>
                                <td style="width: 230px;">Marital Status:</td>
                                <td>
                                    <span style="font-weight: bold">
                                    {{$user->employee_data->marital_status}}</td>
                                    </span>
                            </tr>
                            <tr>
                                <td style="width: 230px;">Address:</td>
                                <td>
                                    <span style="font-weight: bold">
                                    {{$user->employee_data->address}}</td>
                                    </span>
                            </tr>
                            <tr>
                                <td style="width: 230px;">Phone:</td>
                                <td>
                                    <span style="font-weight: bold">
                                    {{$user->employee_data->phone}}</td>
                                    </span>
                            </tr>
                            <tr>
                                <td style="width: 230px;">Phone2:</td>
                                <td>
                                    <span style="font-weight: bold">
                                    {{$user->employee_data->phone2}}</td>
                                    </span>
                            </tr>
                            <tr>
                                <td style="width: 230px;">Phone3:</td>
                                <td>
                                    <span style="font-weight: bold">
                                    {{$user->employee_data->phone3}}</td>
                                    </span>
                            </tr>
                            <tr>
                                <td style="width: 230px;">Spouse phone:</td>
                                <td>
                                    <span style="font-weight: bold">
                                    {{$user->employee_data->spouse_phone}}</td>
                                    </span>
                            </tr>
                            <tr>
                                <td style="width: 230px;">Emergency Contact Name:</td>
                                <td>
                                    <span style="font-weight: bold">
                                    {{$user->employee_data->ec_name}}</td>
                                    </span>
                            </tr>
                            <tr>
                                <td style="width: 230px;">Emergency Contact phone:</td>
                                <td>
                                    <span style="font-weight: bold">
                                    {{$user->employee_data->ec_phone}}</td>
                                    </span>
                            </tr>
                            <tr>
                                <td style="width: 230px;">Emergency Contact Address:</td>
                                <td>
                                    <span style="font-weight: bold">
                                    {{$user->employee_data->ec_address}}</td>
                                    </span>
                            </tr>
                            <tr>
                                <td style="width: 230px;">Next of Kin Name:</td>
                                <td>
                                    <span style="font-weight: bold">
                                    {{$user->employee_data->nok_name}}</td>
                                    </span>
                            </tr>
                            <tr>
                                <td style="width: 230px;">Next of Kin phone:</td>
                                <td>
                                    <span style="font-weight: bold">
                                    {{$user->employee_data->nok_phone}}</td>
                                    </span>
                            </tr>
                            <tr>
                                <td style="width: 230px;">Next of Kin address:</td>
                                <td>
                                    <span style="font-weight: bold">
                                    {{$user->employee_data->nok_address}}</td>
                                    </span>
                            </tr>
                            <tr>
                                <td style="width: 230px;">Date Employed:</td>
                                <td>
                                    <span style="font-weight: bold">
                                    {{$user->employee_data->date_employed}}</td>
                                    </span>
                            </tr>
                            <tr>
                                <td style="width: 230px;">Position Held:</td>
                                <td>
                                    <span style="font-weight: bold">
                                    {{$user->employee_data->position_held}}</td>
                                    </span>
                            </tr>
                            <tr>
                                <td style="width: 230px;">Refree Name:</td>
                                <td>
                                    <span style="font-weight: bold">
                                    {{$user->employee_data->refree1_name}}</td>
                                    </span>
                            </tr>
                            <tr>
                                <td style="width: 230px;">Refree Phone:</td>
                                <td>
                                    <span style="font-weight: bold">
                                    {{$user->employee_data->refree1_phone}}</td>
                                    </span>
                            </tr>
                            <tr>
                                <td style="width: 230px;">Refree Address:</td>
                                <td>
                                    <span style="font-weight: bold">
                                    {{$user->employee_data->refree1_address}}</td>
                                    </span>
                            </tr>
                            <tr>
                                <td style="width: 230px;">Refree2 Name:</td>
                                <td>
                                    <span style="font-weight: bold">
                                    {{$user->employee_data->refree2_name}}</td>
                                    </span>
                            </tr>
                            <tr>
                                <td style="width: 230px;">Refree2 Phone:</td>
                                <td>
                                    <span style="font-weight: bold">
                                    {{$user->employee_data->refree2_phone}}</td>
                                    </span>
                            </tr>
                            <tr>
                                <td style="width: 230px;">Refree2 Address:</td>
                                <td>
                                    <span style="font-weight: bold">
                                    {{$user->employee_data->refree2_address}}</td>
                                    </span>
                            </tr>

                            </tr>
                        </table>


                    </div>
                </div>

        @else

        <div class="card">
            <div class="card-body">

                <h6 class="py-5 text-center">Employee data not updated.</h6>
            </div>
        </div>

        @endif




    </div>

@endsection
