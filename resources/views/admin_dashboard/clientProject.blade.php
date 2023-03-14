@extends('layouts.app')

@section('content')


<div class="page-content">
    <div class="p-3"></div>
    <h4>Project: {{$clientProject->title}}</h4>

    <h6>Milestones</h6>


    <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">


    </div>
    <!--end breadcrumb-->
    <div class="">
        <div class="">
            <div class="container py-2">
                <h2 class="font-weight-light text-center text-muted py-3">Reports</h2>
                <!-- timeline item 1 -->
                <div class="row">
                    <!-- timeline item 1 left dot -->
                    <div class="col-auto text-center flex-column d-none d-sm-flex">
                        <div class="row h-50">
                            <div class="col">&nbsp;</div>
                            <div class="col">&nbsp;</div>
                        </div>
                        <h5 class="m-2">
                        <span class="badge rounded-pill bg-warning border">&nbsp;</span>
                    </h5>
                        <div class="row h-50">
                            <div class="col border-end">&nbsp;</div>
                            <div class="col">&nbsp;</div>
                        </div>
                    </div>
                    <!-- timeline item 1 event content -->
                    <div class="col py-2">
                        <div class="card radius-15">
                            <div class="card-body">
                                <div class="float-end text-muted">Mon, Jan 9th 2020 7:00 AM</div>
                                <h4 class="card-title text-muted">Day 1 Orientation</h4>
                                <p class="card-text">Welcome to the campus, introduction and get started with the tour.</p>
                            </div>
                        </div>
                    </div>
                </div>
                <!--/row-->
                <!-- timeline item 2 -->
                <div class="row">
                    <div class="col-auto text-center flex-column d-none d-sm-flex">
                        <div class="row h-50">
                            <div class="col border-end">&nbsp;</div>
                            <div class="col">&nbsp;</div>
                        </div>
                        <h5 class="m-2">
                        <span class="badge rounded-pill bg-success">&nbsp;</span>
                    </h5>
                        <div class="row h-50">
                            <div class="col border-end">&nbsp;</div>
                            <div class="col">&nbsp;</div>
                        </div>
                    </div>
                    <div class="col py-2">
                        <div class="card border-primary shadow radius-15">
                            <div class="card-body">
                                <div class="float-end text-primary">Tue, Jan 10th 2019 8:30 AM</div>
                                <h4 class="card-title text-primary">Day 2 Sessions</h4>
                                <p class="card-text">Sign-up for the lessons and speakers that coincide with your course syllabus. Meet and greet with instructors.</p>
                                <button class="btn btn-sm btn-outline-secondary" type="button" data-bs-target="#t2_details" data-bs-toggle="collapse">Show Details ▼</button>
                                <div class="collapse border" id="t2_details">
                                    <div class="p-2 text-monospace">
                                        <div>08:30 - 09:00 Breakfast in CR 2A</div>
                                        <div>09:00 - 10:30 Live sessions in CR 3</div>
                                        <div>10:30 - 10:45 Break</div>
                                        <div>10:45 - 12:00 Live sessions in CR 3</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!--/row-->
                <!-- timeline item 3 -->
                <div class="row">
                    <div class="col-auto text-center flex-column d-none d-sm-flex">
                        <div class="row h-50">
                            <div class="col border-end">&nbsp;</div>
                            <div class="col">&nbsp;</div>
                        </div>
                        <h5 class="m-2">
                        <span class="badge rounded-pill bg-light border">&nbsp;</span>
                    </h5>
                        <div class="row h-50">
                            <div class="col border-end">&nbsp;</div>
                            <div class="col">&nbsp;</div>
                        </div>
                    </div>
                    <div class="col py-2">
                        <div class="card radius-15">
                            <div class="card-body">
                                <div class="float-end text-muted">Wed, Jan 11th 2019 8:30 AM</div>
                                <h4 class="card-title">Day 3 Sessions</h4>
                                <p>Shoreditch vegan artisan Helvetica. Tattooed Codeply Echo Park Godard kogi, next level irony ennui twee squid fap selvage. Meggings flannel Brooklyn literally small batch, mumblecore PBR try-hard kale chips. Brooklyn vinyl lumbersexual bicycle rights, viral fap cronut leggings squid chillwave pickled gentrify mustache. 3 wolf moon hashtag church-key Odd Future. Austin messenger bag normcore, Helvetica Williamsburg sartorial tote bag distillery Portland before they sold out gastropub taxidermy Vice.</p>
                            </div>
                        </div>
                    </div>
                </div>
                <!--/row-->
                <!-- timeline item 4 -->
                <div class="row">
                    <div class="col-auto text-center flex-column d-none d-sm-flex">
                        <div class="row h-50">
                            <div class="col border-end">&nbsp;</div>
                            <div class="col">&nbsp;</div>
                        </div>
                        <h5 class="m-2">
                        <span class="badge rounded-pill bg-light border">&nbsp;</span>
                    </h5>
                        <div class="row h-50">
                            <div class="col">&nbsp;</div>
                            <div class="col">&nbsp;</div>
                        </div>
                    </div>
                    <div class="col py-2">
                        <div class="card radius-15">
                            <div class="card-body">
                                <div class="float-end text-muted">Thu, Jan 12th 2019 11:30 AM</div>
                                <h4 class="card-title">Day 4 Wrap-up</h4>
                                <p>Join us for lunch in Bootsy's cafe across from the Campus Center.</p>
                            </div>
                        </div>
                    </div>
                </div>
                <!--/row-->
            </div>
            <!--container-->
            <hr>
          
        </div>
    </div>





    <div class="accordion d-none" id="accordionExample">

        @forelse ($clientProject->milestones as $milestone)

        <div class="card">
            <div class="card-header" id="headingOne{{$milestone->id}}">
              <h2 class="mb-0">
                <button class="btn btn-lin btn-block " type="button" data-toggle="collapse" data-target="#collapseOne{{$milestone->id}}" aria-expanded="true" aria-controls="collapseOne{{$milestone->id}}">
                  {{$loop->iteration}} {{$milestone->title}}
                </button>
              </h2>
              <p style="margin-left: 23px;" class=""><b>{{$milestone->description}}</b></p>
            </div>

            <div id="collapseOne{{$milestone->id}}" class="collapse {{$loop->first?'show':''}}" aria-labelledby="headingOne{{$milestone->id}}" data-parent="#accordionExample">
              <div class="card-body">

                <h6>Reports</h6>

                <div style="background-color: lightgrey;" class="card mb-3 p-2 ">
                    <textarea name="description" class="form-control" id="" rows="5">{{$milestone->description}}</textarea>


                    <div class="container-fluid">

                        <h6 class="py-3">Media</h6>
                        <div class="row">
                            <div class="col-md-3 mb-2">
                                <img style="height: 100px;" class="" src="{{url('/assetsx')}}/img/map@2x.png" alt="">
                                <p class="py-1">
                                    <input type="text" class="form-control" value="Lorem ipsum dolor sit, am Harum exceptur">
                                </p>
                                <button class="btn btn-secondary">update</button>
                            </div>

                            <div class="col-md-3 mb-2">
                                <img style="height: 100px;" class="shadow" src="{{url('/assetsx')}}/img/map@2x.png" alt="">
                                <p class="py-1">
                                    <input type="text" class="form-control shadow" value="" placeholder="Add description">
                                </p>
                                <button class="btn btn-primary shadow">new upload</button>
                            </div>





                        </div>

                    </div>

                </div>

                <div style="background-color: lightgrey;" class="card mb-3 p-2 ">
                    <textarea name="description" class="form-control" id="" rows="5">{{$milestone->description}}</textarea>


                    <div class="container-fluid">

                        <h6 class="py-3">Media</h6>
                        <div class="row">
                            <div class="col-md-3 mb-2">
                                <img style="height: 100px;" class="" src="{{url('/assetsx')}}/img/map@2x.png" alt="">
                                <p class="py-1">
                                    <input type="text" class="form-control" value="Lorem ipsum dolor sit, am Harum exceptur">
                                </p>
                                <button class="btn btn-secondary">update</button>
                            </div>

                            <div class="col-md-3 mb-2">
                                <img style="height: 100px;" class="shadow" src="{{url('/assetsx')}}/img/map@2x.png" alt="">
                                <p class="py-1">
                                    <input type="text" class="form-control shadow" value="" placeholder="Add description">
                                </p>
                                <button class="btn btn-primary shadow">new upload</button>
                            </div>





                        </div>

                    </div>

                </div>

                <hr class="container">



              </div>
            </div>
          </div>

        @empty

        <h6 class="text-center py-5">No Milestones yet.</h6>




        @endforelse


      </div>



    <div class="card col-md-6 d-none">
        <div class="card-body">


            <form action="{{route('projectMilestones.store')}}" method="post">
            @csrf
            <input type="hidden" name="client_project_id" value="{{$clientProject->id}}">

            <div class="form-group py-2">
                <label for="title">Title</label>
                <input type="text" class="form-control" name="title">
            </div>

            <div class="form-group py-2">
                <label for="description">Description</label>
                <input type="text" class="form-control" name="description">
            </div>

            <div class="form-group py-2">
                <label for="description">Due date:</label>
                <input type="date" class="form-control" name="due_date">
            </div>

            <div class="form-group py-2">
                <button type="submit" class="btn btn-primary">Create Milestone</button>
            </div>


            </form>
        </div>
    </div>










</div>

@endsection

