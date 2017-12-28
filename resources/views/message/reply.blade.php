@extends('layouts.app')
@section('content')

<div class="row">
<div class="col-md-6 col-md-offset-3">
  <h1 class="text-center">
    Reply To Message
  </h1>
  <hr>

  @if(count($errors) > 0)
    <div class="alert alert-danger alert-dismissable">
      <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
      @foreach ($errors->all() as $error)
        <ul>
          <li>{{$error}}</li>
        </ul>
      @endforeach
    </div>
  @endif

  @if(!is_null($reply_to_message))
    <div class="well">
      {{ $reply_to_message->title }}<br>
      {{ $reply_to_message->body }}
    </div>
  @endif

    <form class="form" action="{{ route('post_reply', $receiver_id) }}" method="post">
    {{ csrf_field() }}

    <input type="hidden" name="reply_to_message_id"
       value="{{ $reply_to_message->id }}" >

    <div class="form-group">
      <label for="title">Message Title</label>
      <input class="form-control" type="text" name="title" id="title">
    </div>

    <div class="form-group">
      <label for="body">Your Message</label>
      <textarea class="form-control" name="body" id="body"></textarea>
    </div>

    <button class="btn btn-success btn-block" type="submit" name="button">Send</button>

  </form>
  <a href="{{ route('member_page') }}" style="position:relative; top:5px;">[cancel]</a>


</div>
</div>

@endsection
