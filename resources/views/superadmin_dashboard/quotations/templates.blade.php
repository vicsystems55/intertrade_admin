@extends('layouts.app')

@section('content')

<div class="page-content">
<h3>Import Solar Quotation Templates</h3>
<div class="col-md-4 mt-5">

    <div class="card card-body " style="margin-top: 140px;">
        @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    @if($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('import.solar.quotations') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="mb-3">
            <label for="file" class="form-label">Upload Excel File..</label>
            <input type="file" class="form-control" name="file" required>
        </div>
        <button type="submit" class="btn btn-primary">Import</button>
    </form>
    </div>


</div>

<div class="page-content">
@endsection
