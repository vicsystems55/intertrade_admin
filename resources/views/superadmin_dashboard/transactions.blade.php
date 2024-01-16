@extends('layouts.app')


@section('content')

<div class="page-content">
<transactions-component appurl="{{config('app.url')}}" userid="{{Auth::user()->id}}"></transactions-component>

</div>

@endsection
