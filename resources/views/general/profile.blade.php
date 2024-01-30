@extends('layouts.app')


@section('content')
    <div class="page-content">


        <h4 class="py-3">My Profile</h4>

        <div style="max-width: 730px;" class="card mx-auto">
            <div class="card-body">


                @if (Session::has('msgp'))
                    <p class="alert alert-info">{{ Session::get('msgp') }}</p>
                @endif


                <form action="{{ route('update.pix') }}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group text-center">

                            <img id="previewImg2" style="height: 90px; width: 90px; object-fit: cover; border-radius: 20px;"
                                class="shadow rounded-circle"
                                src="{{ asset('storage') }}/{{ Auth::user()->avatar ?? 'default.png' }}">


                    </div>
                    <input type="hidden" name="user_id" value="{{ Auth::user()->id }}">

                    <div class="col-sm-5 mx-auto ">
                        <div class="custom-file mb-2 mt-3 mx-auto">
                            <input onchange="previewFile3(this.id);" type="file" name="avatar" class="form-control"
                                id="formFile">

                            @error('avatar')
                                <span class="text-danger" role="alert">
                                    <span>{{ $message }}</span>
                                </span>
                            @enderror
                        </div>
                        <div class="form-group text-center">
                            <button type="submit" class="btn btn-secondary btn-sm">Update passport</button>
                        </div>
                    </div>

                </form>

                @if ($errors->any())
            @foreach ($errors->all() as $error)
                <p class="alert alert-warning">{{$error}}</p>
            @endforeach
        @endif




                <form action="{{ route('employeedata.update') }}" method="post">
                    @csrf




                    <div class="row px-3">

                        <h6 class="pt-2">Personal Data</h6>
                        <hr>

                        <input type="hidden" name="user_id" value="{{ Auth::user()->id }}">

                        <div class="py-3 col-md-6">
                            <label for="">
                                Surname:
                            </label>
                            <input type="text" class="form-control" value="{{ $employeeData->surname ?? '' }}"
                                name="surname" placeholder="Enter ">
                        </div>

                        <div class="py-3 col-md-6">
                            <label for="">
                                First Name:
                            </label>
                            <input type="text" class="form-control" value="{{ $employeeData->first_name ?? '' }}"
                                name="first_name" placeholder="Enter ">
                        </div>

                        <div class="py-3 col-md-6">
                            <label for="">
                                Middle Name:
                            </label>
                            <input type="text" class="form-control" value="{{ $employeeData->middle_name ?? '' }}"
                                name="middle_name" placeholder="Enter ">
                        </div>

                        <div class="py-3 col-md-6">
                            <label for="">
                                State:
                            </label>


                                <select name="state" id="" class="form-control">

                                    @if ($employeeData)

                                    @foreach ($states as $state)
                                    <option value="{{$state->name}}" {{$employeeData->state==$state->name?'selected':''}}>{{$state->name}}</option>

                                    @endforeach

                                    @else

                                    @foreach ($states as $state)
                                    <option value="{{$state->name}}" >{{$state->name}}</option>

                                    @endforeach

                                    @endif


                                </select>
                        </div>

                        <div class="py-3 col-md-6">
                            <label for="">
                                LGA:
                            </label>


                                <select name="lga" id="" class="form-control">
                                    @if ($employeeData)
                                    @foreach ($lgas as $lga)
                                    <option value="{{$lga->name}}" {{$employeeData->lga==$lga->name?'selected':''}}>{{$lga->name}}</option>

                                    @endforeach
                                    @else

                                    @foreach ($lgas as $lga)
                                    <option value="{{$lga->name}}" >{{$lga->name}}</option>

                                    @endforeach

                                    @endif


                                </select>
                        </div>

                        <div class="py-3 col-md-6">
                            <label for="">
                                Gender:
                            </label>
                            <div class="form-check">

                                @if ($employeeData)
                                <input class="form-check-input" type="radio" name="gender" value="Male" id="flexRadioDefault1" {{ $employeeData->gender == 'Male'?'checked':'' }}>

                                @else
                                <input class="form-check-input" type="radio" name="gender" value="Male" id="flexRadioDefault1" >

                                @endif


                                <label class="form-check-label" for="flexRadioDefault1">Male</label>
                            </div>
                            <div class="form-check">

                                @if ($employeeData)
                                <input class="form-check-input" type="radio" name="gender" value="Female" id="flexRadioDefault2" {{ $employeeData->gender == 'Female'?'checked':'' }}>

                                @else
                                <input class="form-check-input" type="radio" name="gender" value="Female" id="flexRadioDefault2" >

                                @endif


                                <label class="form-check-label" for="flexRadioDefault2">Female</label>
                            </div>

                        </div>

                        <div class="py-3 col-md-6">
                            <label for="">
                                Marital Status:
                            </label>

                            @if ($employeeData)


                            <select name="marital_status" id="" class="form-control">
                                <option value="Married" {{$employeeData->marital_status == 'Married'?'selected':''}}>Married</option>
                                <option value="Single" {{$employeeData->marital_status == 'Single'?'selected':''}}>Single</option>
                                <option value="Others" {{$employeeData->marital_status == 'Others'?'selected':''}}>Others</option>
                            </select>

                            @else


                            <select name="marital_status" id="" class="form-control">
                                <option value="Married" >Married</option>
                                <option value="Single" >Single</option>
                                <option value="Others" >Others</option>
                            </select>

                            @endif


                        </div>

                        <div class="py-3 col-md-6">
                            <label for="">
                                Address:
                            </label>
                            <input type="text" class="form-control" value="{{ $employeeData->address ?? '' }}"
                                name="address" placeholder="Enter ">
                        </div>

                        <div class="py-3 col-md-6">
                            <label for="">
                                Phone:
                            </label>
                            <input type="text" class="form-control" value="{{ $employeeData->phone ?? '' }}"
                                name="phone" placeholder="Enter ">
                        </div>

                        <div class="py-3 col-md-6">
                            <label for="">
                                Phone 2:
                            </label>
                            <input type="text" class="form-control" value="{{ $employeeData->phone2 ?? '' }}"
                                name="phone2" placeholder="Enter ">
                        </div>

                        <div class="py-3 col-md-6">
                            <label for="">
                                Phone 3:
                            </label>
                            <input type="text" class="form-control" value="{{ $employeeData->phone3 ?? '' }}"
                                name="phone3" placeholder="Enter ">
                        </div>

                        <div class="py-3 col-md-6">
                            <label for="">
                                Spouse Phone:
                            </label>
                            <input type="text" class="form-control" value="{{ $employeeData->spouse_phone ?? '' }}"
                                name="spouse_phone" placeholder="Enter ">
                        </div>

                        <h6 class="pt-2">Emergency Contact</h6>
                        <hr>

                        <div class="py-3 col-md-6">
                            <label for="">
                                Emergency Cont:act Name
                            </label>
                            <input type="text" class="form-control" value="{{ $employeeData->ec_name ?? '' }}"
                                name="ec_name" placeholder="Enter ">
                        </div>

                        <div class="py-3 col-md-6">
                            <label for="">
                                Emergency Phone:
                            </label>
                            <input type="text" class="form-control" value="{{ $employeeData->ec_phone ?? '' }}"
                                name="ec_phone" placeholder="Enter ">
                        </div>

                        <div class="py-3 col-md-6">
                            <label for="">
                                Emergency Address:
                            </label>
                            <input type="text" class="form-control" value="{{ $employeeData->ec_address ?? '' }}"
                                name="ec_address" placeholder="Enter ">
                        </div>

                        <h6 class="pt-2">Next of kin details</h6>
                        <hr>

                        <div class="py-3 col-md-6">
                            <label for="">
                                Next of Kin Name:
                            </label>
                            <input type="text" class="form-control" value="{{ $employeeData->nok_name ?? '' }}"
                                name="nok_name" placeholder="Enter ">
                        </div>

                        <div class="py-3 col-md-6">
                            <label for="">
                                Next of Kin Phone:
                            </label>
                            <input type="text" class="form-control" value="{{ $employeeData->nok_phone ?? '' }}"
                                name="nok_phone" placeholder="Enter ">
                        </div>

                        <div class="py-3 col-md-6">
                            <label for="">
                                Next of Kin Address:
                            </label>
                            <input type="text" class="form-control" value="{{ $employeeData->nok_address ?? '' }}"
                                name="nok_address" placeholder="Enter ">
                        </div>

                        <h6 class="pt-2">Employment details</h6>
                        <hr>

                        <div class="py-3 col-md-6">
                            <label for="">
                                Date Employed:
                            </label>
                            <input type="date" class="form-control" value="{{ $employeeData->date_employed ?? '' }}"
                                name="date_employed" placeholder="Enter ">
                        </div>

                        <div class="py-3 col-md-6">
                            <label for="">
                                Position Held:
                            </label>
                            <input type="text" class="form-control" value="{{ $employeeData->position_held ?? '' }}"
                                name="position_held" placeholder="Enter ">
                        </div>
                        <h6 class="pt-2">Refrees</h6>
                        <hr>

                        <div class="py-3 col-md-6">
                            <label for="">
                                Refree Name:
                            </label>
                            <input type="text" class="form-control" value="{{ $employeeData->refree1_name ?? '' }}"
                                name="refree1_name" placeholder="Enter ">
                        </div>

                        <div class="py-3 col-md-6">
                            <label for="">
                                Refree1 Phone:
                            </label>
                            <input type="text" class="form-control" value="{{ $employeeData->refree1_phone ?? '' }}"
                                name="refree1_phone" placeholder="Enter ">
                        </div>

                        <div class="py-3 col-md-6">
                            <label for="">
                                Refree Address:
                            </label>
                            <input type="text" class="form-control" value="{{ $employeeData->refree1_address ?? '' }}"
                                name="refree1_address" placeholder="Enter ">
                        </div>

                        <hr>

                        <div class="py-3 col-md-6">
                            <label for="">
                                Refree Name:
                            </label>
                            <input type="text" class="form-control" value="{{ $employeeData->refree2_name ?? '' }}"
                                name="refree2_name" placeholder="Enter ">
                        </div>

                        <div class="py-3 col-md-6">
                            <label for="">
                                Refree Phone:
                            </label>
                            <input type="text" class="form-control" value="{{ $employeeData->refree2_phone ?? '' }}"
                                name="refree2_phone" placeholder="Enter ">
                        </div>

                        <div class="py-3 col-md-6">
                            <label for="">
                                Refree Address:
                            </label>
                            <input type="text" class="form-control" value="{{ $employeeData->refree2_address ?? '' }}"
                                name="refree2_address" placeholder="Enter ">
                        </div>


                    </div>



                    <div class="form-group col-md-10 mx-auto text-center py-3">
                        <button type="sumbit" class="btn btn-primary btn-block col-md-6 mx-auto">Submit</button>
                    </div>

                </form>

            </div>
        </div>

        <script>
            function previewFile4(chooser) {
                console.log('hello');

                var file = $('#' + chooser).get(0).files[0];

                if (file) {
                    var reader = new FileReader();

                    reader.onload = function() {
                        var previewer = chooser + '_preview';

                        // $('#' + previewer).css('background-image', 'url("' + reader.result + '")');
                        $("#previewImg").attr("src", reader.result);

                        // $("#bg-img").css("background-image", "url(" + reader.result + ")");
                    }

                    reader.readAsDataURL(file);
                }
            }

            function previewFile3(chooser) {
                console.log('hello');

                var file = $('#' + chooser).get(0).files[0];

                if (file) {
                    var reader = new FileReader();

                    reader.onload = function() {
                        var previewer = chooser + '_preview';

                        // $('#' + previewer).css('background-image', 'url("' + reader.result + '")');
                        $("#previewImg2").attr("src", reader.result);

                        // $("#bg-img").css("background-image", "url(" + reader.result + ")");
                    }

                    reader.readAsDataURL(file);
                }
            }
        </script>



    </div>
@endsection
