@extends('layouts.app')

@section('content')

<div class="page-content">
<h2>Import Solar Quotation Templates</h2>
<div class="container card card-body col-md-5 mx-auto">

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
            <label for="file" class="form-label">Upload Excel File</label>
            <input type="file" class="form-control" name="file" required>
        </div>
        <button type="submit" class="btn btn-primary">Import</button>
    </form>
</div>

<div class="page-content">
@endsection
