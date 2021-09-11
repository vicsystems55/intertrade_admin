@extends('layouts.app')


@section('content')


<div class="page-content">
    <div class="p-5"></div>

    <h4>My Profile</h4>

    <div class="card">
        <div class="card-body">

            <form action="" method="post">
                @csrf
                
                <div class="form-group text-center">
                    <img id="previewImg2" style="height: 90px; width: 90px; object-fit: cover; border-radius: 20px;" class="shadow rounded-circle" src="{{config('app.url')}}avatars/{{$profile_data->users->avatar??'default.png'}}" >

                </div> 

              <div class="col-sm-5 mx-auto">
                <div class="custom-file mb-5 mt-3 mx-auto">
                    <input onchange="previewFile3(this.id);" type="file" name="avatar" class="form-control" id="formFile">
                    
                    @error('avatar')
                    <span class="text-danger" role="alert">
                        <span>{{ $message }}</span>
                    </span>
                    @enderror
                </div>
              </div>


              <div class="row px-3">
                  <div class="col-md-6">

                    <div class="form-group mb-3">
                        <label for="">Fullname:</label>
                        <input type="text" class="form-control" name="name" placeholder="Full name">
                        @error('avatar')
                        <span class="text-danger" role="alert">
                            <span>{{ $message }}</span>
                        </span>
                        @enderror
                    </div>

                    <div class="form-group mb-3">
                        <label for="">Email:</label>
                        <input type="text" class="form-control" name="name" placeholder="Full name">
                        @error('avatar')
                        <span class="text-danger" role="alert">
                            <span>{{ $message }}</span>
                        </span>
                        @enderror
                    </div>

                    <div class="form-group mb-3">
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="flexRadioDefault" id="flexRadioDefault1">
                            <label class="form-check-label" for="flexRadioDefault1">Male</label>
                        </div>

                        
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="flexRadioDefault" id="flexRadioDefault1">
                            <label class="form-check-label" for="flexRadioDefault1">Female</label>
                        </div>
                    </div>

                    <div class="form-group mb-3">
                        <label for="">Address:</label>
                        <input type="text" class="form-control" name="name" placeholder="Full name">
                        @error('avatar')
                        <span class="text-danger" role="alert">
                            <span>{{ $message }}</span>
                        </span>
                        @enderror
                    </div>




                  </div>
                  <div class="col-md-6">

                    <div class="form-group mb-3">
                        <label for="">Bio:</label>
                
                        <textarea name="bio" id="" cols="30" rows="5" class="form-control" placeholder="Max Char (230)"></textarea>
                        @error('avatar')
                        <span class="text-danger" role="alert">
                            <span>{{ $message }}</span>
                        </span>
                        @enderror
                    </div>




                  </div>
              </div>



              <div class="form-group col-md-10 mx-auto text-center">
                <button type="sumbit" class="btn btn-primary btn-block col-md-6 mx-auto" >Submit</button>
            </div>

            </form>

        </div>
    </div>

    <script>
        function previewFile4(chooser){
            console.log('hello');
    
            var file = $('#' + chooser).get(0).files[0];
    
            if(file){
                var reader = new FileReader();
    
                reader.onload = function(){
                    var previewer = chooser +'_preview';
                
                    // $('#' + previewer).css('background-image', 'url("' + reader.result + '")');
                    $("#previewImg").attr("src", reader.result);
                    
                    // $("#bg-img").css("background-image", "url(" + reader.result + ")");
                }
    
                reader.readAsDataURL(file);
            }
        }
    
        function previewFile3(chooser){
            console.log('hello');
    
            var file = $('#' + chooser).get(0).files[0];
    
            if(file){
                var reader = new FileReader();
    
                reader.onload = function(){
                    var previewer = chooser +'_preview';
                
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