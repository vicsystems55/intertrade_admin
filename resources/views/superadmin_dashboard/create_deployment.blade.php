@extends('layouts.app')


@section('content')


<div class="page-content">
    <div class="p-5"></div>

    <h4>Create Zone</h4>



    <div class="card mb-5">
        <div class="card-body">

                   
@if ($errors->any())
@foreach ($errors->all() as $error)
    <p class="alert alert-warning">{{$error}}</p>
@endforeach
@endif


            <form action="{{route('create_deployment_zone')}}" method="post">

                @csrf

                <div class="row">
                    <div class="col-md-6">

                        <div class="form-group mb-3">
                            <label for="">Site Type:</label>
                            <input type="text" class="form-control" name="site_type" placeholder="Enter Site Type">
                        </div>
        
                        <div class="form-group mb-3">
                            <label for="">Enter State</label>
                            <select class="form-control" name="state">
                                <option disabled selected>--Select State--</option>
                                <option value="Abia">Abia</option>
                                <option value="Adamawa">Adamawa</option>
                                <option value="Akwa Ibom">Akwa Ibom</option>
                                <option value="Anambra">Anambra</option>
                                <option value="Bauchi">Bauchi</option>
                                <option value="Bayelsa">Bayelsa</option>
                                <option value="Benue">Benue</option>
                                <option value="Borno">Borno</option>
                                <option value="Cross Rive">Cross River</option>
                                <option value="Delta">Delta</option>
                                <option value="Ebonyi">Ebonyi</option>
                                <option value="Edo">Edo</option>
                                <option value="Ekiti">Ekiti</option>
                                <option value="Enugu">Enugu</option>
                                <option value="FCT">Federal Capital Territory</option>
                                <option value="Gombe">Gombe</option>
                                <option value="Imo">Imo</option>
                                <option value="Jigawa">Jigawa</option>
                                <option value="Kaduna">Kaduna</option>
                                <option value="Kano">Kano</option>
                                <option value="Katsina">Katsina</option>
                                <option value="Kebbi">Kebbi</option>
                                <option value="Kogi">Kogi</option>
                                <option value="Kwara">Kwara</option>
                                <option value="Lagos">Lagos</option>
                                <option value="Nasarawa">Nasarawa</option>
                                <option value="Niger">Niger</option>
                                <option value="Ogun">Ogun</option>
                                <option value="Ondo">Ondo</option>
                                <option value="Osun">Osun</option>
                                <option value="Oyo">Oyo</option>
                                <option value="Plateau">Plateau</option>
                                <option value="Rivers">Rivers</option>
                                <option value="Sokoto">Sokoto</option>
                                <option value="Taraba">Taraba</option>
                                <option value="Yobe">Yobe</option>
                                <option value="Zamfara">Zamfara</option>
                            </select>
                        </div>

                        <div class="form-group mb-3">
                            <label for="">Enter Distric Name:</label>
                            <input type="text" class="form-control" name="district" placeholder="District">
                        </div>

                        <div class="form-group mb-3">
                            <label for="">Facility Address:</label>
                            <input type="text" name="facility_address" class="form-control" placeholder="Enter Facility Address">
                        </div>

                        <div class="form-group mb-3">
                            <label for="">Facility Address:</label>
                            <input type="text" name="facility_name" class="form-control" placeholder="Enter Facility Name">
                        </div>

                        <div class="form-group mb-3">
                            <label for="">Closet Town:</label>
                            <input type="text" name="closest_town" class="form-control" placeholder="Enter town closet to installation site">
                        </div>

                      



                        



                    </div>
                    <div class="col-md-6">

                        <div class="form-group mb-3">
                            <label for="">Officer In Charge (OIC):</label>
                            <input type="text" name="project_OIC" class="form-control" placeholder="Full name of Officer In Charge">
                        </div>

                        <div class="form-group mb-3">
                            <label for="">Contact Number:</label>
                            <input type="text" name="contact_number" class="form-control" placeholder="Phone number of Officer In Charge">
                        </div>

                        <div class="form-group mb-3">
                            <label for="">Contact Email:</label>
                            <input type="email" name="contact_mail" class="form-control" placeholder="Email of Officer In Charge">
                        </div>


                        <div class="form-group mb-3">
                            <label for="">Number of UCCs:</label>
                            <input type="number" name="no_ucc" class="form-control" placeholder="Number of UCCs">
                        </div>

                        <div class="form-group mb-3">
                            <label for="">Road Access:</label>
                            <input type="text" name="road_access" class="form-control" placeholder="Number of UCCs">
                        </div>

                        <div class="form-group mb-3">
                            <label for="">Warehouse Distance:</label>
                            <input type="number" name="ware_house_distance" class="form-control" placeholder="Distance from warehouse">
                        </div>

                        <div class="form-group mb-3">
                            <label for="">Road Quality:</label>
                            <input type="number" name="road_quality" class="form-control" placeholder="What is the quality of the road">
                        </div>



                    </div>
                </div>
               
            </form>



        </div>
    </div>

    <div class="card">
        <div class="card-body">


            <table class="table table-striped table-hove">
                <thead>
                    <tr>
                        <th>State</th>
                        <th>Facility Address</th>
                        <th>Facility Name</th>
                        <th>Closet Town</th>
                        <th>OIC</th>
                        <th>Contact Number</th>
                        <th>Contact Email</th>
                        <th>Number of UCCs</th>
                    </tr>
                </thead>

                <tbody>

                        @forelse ($deployments as $deployment)

                        <tr>
                            <th>{{$deployment->state}}</th>
                            <th>{{$deployment->facility_address}}</th>
                            <th>{{$deployment->facility_name}}</th>
                            <th>{{$deployment_closet_town}}</th>
                            <th>{{$deployment->project_OIC}}}</th>
                            <th>{{$deployment->contact_number}}</th>
                            <th>{{$deployment->contact_email}}</th>
                            <th>{{$deployment->no_ucc}}</th>
                        </tr>
                            
                        @empty
                            
                        @endforelse

                </tbody>
            </table>


        </div>
    </div>
</div>
    
@endsection