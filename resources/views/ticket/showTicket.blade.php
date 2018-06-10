@extends('layouts.app')
@section('title')
    Blog - Detail of ticket
@endsection

@section('content')
    <h1>{{$ticket->subject}}</h1>
    <h6>Status : </h6><h6>{{$ticket->status}}</h6>
    <p>{{$ticket->content}}</p>
    @if($ticket->creator_id == Auth::user()->id)
    <a href="{{route('update', ['slug' => $ticket->slug])}}"> <button class="btn btn-info">Update</button></a>
    <a href="{{route('delete', ['slug' => $ticket->slug])}}"><button class="btn btn-danger">Delete</button></a>
    @endif
    <br/>
    <br/>

    @if($messages->count() != 0)
    <h2>Messages : </h2>
    @foreach($messages as $message )
        <nav>
            <ul>
                <li>
                    {{$message->content}}
                </li>

            </ul>
        </nav>
    @endforeach
    @endif
    <br/>
    @if($ticket->status == 'open')
    <form method="post" action="{{route('createMessage')}}">
        <div class="form-group">
            <label for="subject">Your name</label>
            <input type="text" name="subject" id="subject" class="form-control" disabled value="{{ Auth::user()->name }} ">
        </div>
        <div class="form-group">
            <label for="content">Leave a message</label>
            <textarea name="content" id="content" class="form-control">
      </textarea>
        </div>
        <input type="hidden" name="id" value="{{ $ticket->id }}">
        <input type="hidden" name="slug" value="{{ $ticket->slug }}">
        <input type="hidden" name="_token" value="{{ csrf_token() }}">
        <div class="form-group">
            <button class="btn btn-info" type="submit">Add</button>
        </div>
    </form>
@endif

@endsection