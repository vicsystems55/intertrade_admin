<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css" integrity="sha384-xOolHFLEh07PJGoPkLv1IbcEPTNtaed2xpHsD9ESMhqIYd0nLMwNLD69Npy4HI+N" crossorigin="anonymous">

    <title>File manager</title>
  </head>
  <body>
   <div class="container">
    <div class="mt-5">
        <h4 class="text-center py-3">Intertrade Data Center</h4>

        <div class="row">
            @forelse ($media_category as $category)
            <div class="col-md-4">
                <div style="height: 150px;" class="card shadow bt m-1">
                    <div class="card-body">

                        <h5>{{$category->name}}</h5>

                        <h6 class="text-muted text-italics">files ({{$category->mediaCategory->count()}})</h6>



                    </div>
                    <div class="card-footer">
                        <a href="/media/category/{{$category->id}}" class="btn btn-primary btn-sm float-right">view</a>
                    </div>
                </div>
            </div>

            @empty

            <h6 class="text-center"> No categories yet...</h6>

            @endforelse


        </div>

        <div class="mt-3">

            <div class="card div card-body">


      <div class="col-md-6 mx-auto">
        @if ($errors->any())
        @foreach ($errors->all() as $error)
            <p class="alert alert-warning">{{$error}}</p>
        @endforeach
        @endif
      </div>

              <form action="/upload-media" method="post" enctype="multipart/form-data">
                @csrf
                <div class="col-md-6 mx-auto">

                    <div class="form-group">
                        <label for="">Enter your email:</label>

                        <input type="text" name="email" class="form-control" placeholder="Enter email">
                    </div>

                   {{-- <div class="form-group">
                       <label for="">Select Account:</label>
                       <select name="" id="" class="form-control">
                        @foreach ($users as $user)
                            <option value="{{$user->id}}">{{$user->email}}</option>
                        @endforeach
                       </select>
                   </div> --}}
                   <div class="form-group">
                    <label for="">Select Category:</label>
                    <select name="media_category" id="" class="form-control">
                        @foreach ($media_category as $category)
                        <option value="{{$category->id}}">{{$category->name}}</option>
                        @endforeach
                    </select>
                    </div>
                    <div class="form-group">
                        <label for="">Name</label>
                        <input type="text" name="name" class="form-control">
                    </div>
                   <div class="form-group">
                       <label for="">Description</label>
                     <textarea name="description" id="" cols="30" rows="5" class="form-control" placeholder="Describe file to be uploaded"></textarea>
                   </div>
                   <div class="form-group">
                    <label for="exampleFormControlFile1">Upload file(s)</label>
                    <input type="file" name="media" class="form-control-file" id="exampleFormControlFile1">
                  </div>
                    <div class="form-group">
                        <button class="btn btn-primary btn-block btn-lg" type="submit">Upload</button>
                    </div>
                </div>
              </form>
            </div>

        </div>

        <div class="mt-3">

            <div class="card  card-body">
                <table class="table">
                    <thead>
                        <tr>
                            <th>#</th>

                            <th>Info</th>
                            <th></th>
                        </tr>

                    </thead>
                    <tbody>
                        <tr>
                            <td></td>

                            <td>

                                frile.png <br>
                                <i>victor@intertradeltd.biz</i> <br>
                                <i>12mins ago</i>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>

        </div>
    </div>
   </div>

    <!-- Optional JavaScript; choose one of the two! -->

    <!-- Option 1: jQuery and Bootstrap Bundle (includes Popper) -->
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-Fy6S3B9q64WdZWQUiU+q4/2Lc9npb8tCaSX9FK7E8HnRr0Jz8D6OP9dO5Vg3Q9ct" crossorigin="anonymous"></script>

    <!-- Option 2: Separate Popper and Bootstrap JS -->
    <!--
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.min.js" integrity="sha384-+sLIOodYLS7CIrQpBjl+C7nPvqq+FbNUBDunl/OZv93DB7Ln/533i8e/mZXLi/P+" crossorigin="anonymous"></script>
    -->
  </body>
</html>