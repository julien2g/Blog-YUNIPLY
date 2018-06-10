@extends('layouts.app')

@section('title')
    Blog - {{isset($ticket->slug) ? 'Update' : 'Add'}} ticket
@endsection

@section('content')
<form method="post" action="{{ isset($ticket->slug) ? route('update', ['slug' => $ticket->slug ]) : route('createTicket')}} ">
    <div class="form-group">
<label for="subject">Subject</label>
        <input type="text" name="subject" id="subject" class="form-control" value="{{$ticket->subject or ''}}">
    </div>
    <div class="form-group">
        <label for="status">Status</label>
    <select name="status" id="status" class="form-control">
        <option value="{{$ticket->status or 'open'}}">{{$ticket->status or 'Please select'}}</option>
        <option value="open">Open</option>
        <option value="close">Close</option>
    </select>
    </div>
    <div class="form-group">
        <label for="content">Content</label>
      <textarea name="content" id="content" class="form-control">
{{$ticket->content or ''}}
      </textarea>
    </div>
    <input type="hidden" name="slug" value="{{ $ticket->slug or '' }}">
    <input type="hidden" name="_token" value="{{ csrf_token() }}">
    <div class="form-group">
       <button class="btn btn-info" type="submit">Add</button>
    </div>
</form>
    @endsection