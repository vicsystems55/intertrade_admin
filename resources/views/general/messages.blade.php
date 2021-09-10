@extends('layouts.app')


@section('content')


<div class="page-content">
    <div class="p-5"></div>

    <h4>Messages</h4>

    <div class="row">
        <div class="col-md-6">

            <div class="card radius-10">
                <div class="card-body">
                    <ul class="list-unstyled">

                        @forelse ($messages as $message)

                            
                        <li class="d-flex align-items-center border-bottom pb-2">
                            <img src="{{$message->fr_oms->avatar}}" class="rounded-circle p-1 border" width="90" height="90" alt="...">
                            <div class="flex-grow-1 ms-3">
                                <h6>{{$message->fr_oms->name}}</h6>
                                <h5 class="mt-0 mb-1">{{$message->title}}</h5>
                                {{$message->body}}
                        </li>
                            
                        @empty

                        <div class="pt-5">
                            <h4 class="text-center">Empty...</h4>
                        </div>
                            
                        @endforelse


                        
                    </ul>
                </div>
            </div>


        </div>
        <div class="col-md-6">

            @if(Session::has('message'))
            <p class="alert alert-info">{{ Session::get('message') }}</p>
            @endif


            <form action="{{route('send_message')}}" method="post">
                @csrf
                <div class="form-group mb-3">
                    <label for="">To</label>
                    <select name="t_o" id="" class="form-control">
                        <option value="">Select Recipient</option>

                        @forelse ($users as $user)

                            <option value="{{$user->id}}">{{$user->name}}</option>
                            
                        @empty
                            
                        @endforelse
                       
                    </select>
                </div>

                <div class="form-group mb-3">
                    <label for="">Title</label>
                    <input name="title" type="text" class="form-control" placeholder="Message Title">
                </div>

                <div class="form-group mb-3">
                    <label for="">Message</label>

                    <textarea name="body" id="" cols="30" rows="7" class="form-control" placeholder="Message Body (Max 2550 Chars.)"></textarea>
                </div>

                <div class="form-group mb-3">
                    <button type="submit" class="btn btn-primary shadow">Send Message</button>
                </div>

            </form>


        </div>
    </div>
</div>
    
@endsection