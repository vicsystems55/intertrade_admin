@extends('layouts.app')
@section('content')


<div class="page-content">

    <div class="mt-5 col-md-6">

        @if(Session::has('message'))
            <p class="alert alert-info">{{ Session::get('message') }}</p>
            @endif

        <form action="/admin/update-app" method="post">
            @csrf
            <input type="hidden" name="update" value="launch">
            <div class="form-group">
                <button class="btn btn-secondary">Update Application</button>
            </div>
        </form>
    </div>
</div>

@endsection
