@extends('layouts.app')




@section('content')

<div class="page-content">

    <products-component  appurl="{{config('app.url')}}" userid="{{Auth::user()->id}}"  ></products-component>
</div>

@endsection
