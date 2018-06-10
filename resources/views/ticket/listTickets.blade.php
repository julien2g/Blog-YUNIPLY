@extends('layouts.app')

@section('title')
    Blog - List of tickets
@endsection

 @section('content')

    @foreach($tickets as $ticket )
        <h1>{{$ticket->subject}}</h1>
        <p>{{$ticket->status}}</p>
           <a href="{{route('show', ['slug' => $ticket->slug])}}"> <button class="btn btn-info">Details</button></a>

    @endforeach

@endsection