@extends('layouts.app')


@section('content')

    <div class="page-content">
        <div class="p-2"></div>

        <h4>POS</h4>

        <example-component appurl="{{config('app.url')}}" userid="{{Auth::user()->id}}"></example-component>



    </div>

    
@endsection