@extends('layouts.app')



@section('content')
<div class="page-content">

    <product-categories-component appurl="{{config('app.url')}}" userid="{{Auth::user()->id}}"></product-categories-component>
</div>
@endsection
