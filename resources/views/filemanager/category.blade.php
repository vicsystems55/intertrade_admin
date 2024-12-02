<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css" integrity="sha384-xOolHFLEh07PJGoPkLv1IbcEPTNtaed2xpHsD9ESMhqIYd0nLMwNLD69Npy4HI+N" crossorigin="anonymous">
    <title>File manager</title>
</head>

<body>


    <!-- Optional JavaScript; choose one of the two! -->

    <div class="container py-5">

        <a href="/media" class="text-center btn btn-primary">Back to Library</a>

        <div class="display-4 py-3" style="font-size: 180%;">{{ $media_category->name }}</div>
    </div>


    <div class="container">
        @if (Session::has('msg'))
            <p class="alert alert-danger">{{ Session::get('msg') }}</p>
        @endif


    {{$media->links()}}







        <div class="row">

            @foreach ($media as $media_file)
                <div class="col-md-3">
                    <div class="card card-body m-1 p-1">
                        <a style="position: absolute; top: 0; left: 0;" class="btn btn-primary"
                            href="{{ $media_file->download_url }}" download=""><i
                                class="fa-solid fa-download"></i></a>



                        @if ($media_file->type == 'video/mp4')
                            <video controls>
                                <source src="{{ $media_file->url }}" type="video/mp4">
                                <source src="{{ $media_file->url }}" type="video/ogg">

                            </video>
                        @else
                            @if ($media_file->url)
                                <img style="height: 220px; object-fit: cover;"
                                    src="{{ $media_file->download_url ?? asset('media_bank/file.png') }}" alt="">
                            @else
                                <img style="height: 220px; object-fit: cover;" src="{{ asset('media_bank/file.png') }}"
                                    alt="">
                            @endif
                        @endif





                        <div class="" style="font-size: 9pt;">
                            {{ $media_file->name }} <br>
                            {{ number_format($media_file->size / 1000024, 2) }}MB <br>
                            <span class="text-muted font-italics">{{ $media_file->uploadedBy->name }}</span>
                        </div>
                        <form method="post" action="{{ route('media.delete') }}">
                            @csrf
                            <input type="hidden" name="mediaId" value="{{ $media_file->id }}">
                            <input type="hidden" name="categoryID" value="{{ $media_category->id }}">

                            <button style="position: absolute; top: 0; right: 0;" class="text-white btn btn-danger "
                                type="submit">x</button>

                        </form>
                    </div>
                </div>
            @endforeach
        </div>



        {{$media->links()}}
    </div>
</body>

<script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-Fy6S3B9q64WdZWQUiU+q4/2Lc9npb8tCaSX9FK7E8HnRr0Jz8D6OP9dO5Vg3Q9ct" crossorigin="anonymous"></script>

</body>



</html>
