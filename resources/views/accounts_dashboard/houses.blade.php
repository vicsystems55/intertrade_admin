<h1>Cars</h1>

@foreach ($notifications as $notification)
    <div class="row">
        <div class="col-md-6">
            <div class="card shadow mb-3">
                <div class="card-body">
                <h4 class="text-center">{{$notification->title}}</h4>
                </div>
            </div>
        </div>
    </div>
@endforeach