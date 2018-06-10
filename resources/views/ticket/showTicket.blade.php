@extends('layouts.app')
@section('title')
    Blog - Detail of ticket
@endsection

@section('content')
    <h1>{{$ticket->subject}}</h1>
    <h5>{{$ticket->status}}</h5>
    <p>{{$ticket->content}}</p>
    <a href="{{route('update', ['slug' => $ticket->slug])}}"> <button class="btn btn-info">Update</button></a>
    <a href="{{route('delete', ['slug' => $ticket->slug])}}"><button class="btn btn-danger">Delete</button></a>
<br/>
    <br/>

    <h2>Messages : </h2>
    @foreach($messages as $message )
        <p>{{$message->content}}</p>
    @endforeach
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