<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css" integrity="sha384-xOolHFLEh07PJGoPkLv1IbcEPTNtaed2xpHsD9ESMhqIYd0nLMwNLD69Npy4HI+N" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css" integrity="sha384-xOolHFLEh07PJGoPkLv1IbcEPTNtaed2xpHsD9ESMhqIYd0nLMwNLD69Npy4HI+N" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.3.0/css/all.min.css" integrity="sha512-SzlrxWUlpfuzQ+pcUCosxcglQRNAq/DZjVsC0lE40xsADsfeQoEypE+enwcOiGjk/bSuGGKHEyjSoQ1zVisanQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <title>File manager</title>
  </head>
  <body>

       <!-- Optional JavaScript; choose one of the two! -->

       <div class="container py-5">

        <a href="/media" class="text-center btn btn-primary">Back to Library</a>

           <div class="display-4 py-3" style="font-size: 180%;">{{$media_category->name}}</div>
       </div>


       <div class="container">
        @if(Session::has('msg'))
<p class="alert alert-danger">{{ Session::get('msg') }}</p>
@endif


        <div class="row">

            @foreach ($media_category->mediaCategory as $media)
            <div class="col-md-3">
                <div class="card card-body m-1 p-1">
                    <a style="position: absolute; top: 0; left: 0;" class="btn btn-primary" href="{{$media->mediaFiles->download_url}}" download=""><i class="fa-solid fa-download"></i></a>



                    @if ($media->mediaFiles->type == 'video/mp4')

                    <video  controls>
                        <source src="{{$media->mediaFiles->url}}" type="video/mp4">
                        <source src="{{$media->mediaFiles->url}}" type="video/ogg">

                      </video>



                    @else

                    @if($media->mediaFiles->url)
                    <img style="height: 220px; object-fit: cover;" src="{{$media->mediaFiles->download_url??asset('media_bank/file.png')}}" alt="">
                    @else
                    <img style="height: 220px; object-fit: cover;" src="{{asset('media_bank/file.png')}}" alt="">
                    @endif




                    @endif





              <div class="" style="font-size: 9pt;">
                {{$media->mediaFiles->name}} <br>
                {{number_format($media->mediaFiles->size/1000024,2)}}MB <br>
                <span class="text-muted font-italics">{{$media->mediaFiles->uploadedBy->name}}</span>
              </div>
                    <form  method="post" action="{{route('media.delete')}}">
                        @csrf
                        <input type="hidden" name="mediaId" value="{{$media->mediaFiles->id}}">
                        <input type="hidden" name="categoryID" value="{{$media_category->id}}">

                        <button style="position: absolute; top: 0; right: 0;" class="text-white btn btn-danger " type="submit"  >x</button>

                    </form>
                </div>
            </div>

            @endforeach
        </div>

       </div>
  </body>
    <!-- Option 1: jQuery and Bootstrap Bundle (includes Popper) -->
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-Fy6S3B9q64WdZWQUiU+q4/2Lc9npb8tCaSX9FK7E8HnRr0Jz8D6OP9dO5Vg3Q9ct" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.3.0/js/all.min.js" integrity="sha512-2bMhOkE/ACz21dJT8zBOMgMecNxx0d37NND803ExktKiKdSzdwn+L7i9fdccw/3V06gM/DBWKbYmQvKMdAA9Nw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <!-- Option 2: Separate Popper and Bootstrap JS -->
    <!--
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.min.js" integrity="sha384-+sLIOodYLS7CIrQpBjl+C7nPvqq+FbNUBDunl/OZv93DB7Ln/533i8e/mZXLi/P+" crossorigin="anonymous"></script>
    -->
  </body>
</html>

