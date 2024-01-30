@extends('layouts.app')


@section('content')


<div class="page-content">
    <div class="p-2"></div>

    <h4>Notifications</h4>


    <div class="list-group">

        @forelse ($notifications as $notification)

        <a href="#" class="list-group-item list-group-item-action mb-3">
            <div class="d-flex w-100 justify-content-between">
              <h5 class="mb-1">{{$notification->title}}</h5>
              <small class="text-muted">{{$notification->created_at->diffForHumans()}}</small>
            </div>
            <p class="mb-1">{{$notification->body}}</p>

          </a>

        @empty



        <div class="c ">

            <div class="p-5"></div>
            <h4 class="text-center">Empty...</h4>
        </div>

        @endforelse





      </div>

      {{ $notifications->render("pagination::bootstrap-4") }}
</div>

@endsection
