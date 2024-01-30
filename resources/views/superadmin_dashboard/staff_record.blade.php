@extends('layouts.app')


@section('content')


    <div class="page-content">

        <div class="p-5"></div>


        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col-md-6">
                        <div class="p-md-5"></div>
                        <div class="p-md-5"></div>

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

                            <tr>
                                <td>
                                    <span>DESIGNATION:</span>
                                </td>
                                <td>
                                    <span style="font-weight: bold;" class="font-weight-bold">{{$user->role}}</span>
                                </td>
                            </tr>


                        </table>





                    </div>

                    <div class="col-md-6 text-center">

                        <div class="c mb-3">
                            <img src="{{assest('storage')}}/{{$user->avatar}}" style="object-fit: cover;" alt="" class="shadow rounded rounded-circle img-thumbnail">
                        </div>
                        <div style="font-weight: bold;" class=" mb-3">
                            {{$user->user_code}}
                        </div>

                        <div class="c mb-3">

                                <button class="btn btn-primary">Deativate?</button>

                        </div>

                        <div class="c mb-3">

                            <button class="btn btn-primary">Change Priviledge?</button>

                    </div>


                    </div>
                </div>
            </div>
        </div>




    </div>

@endsection
