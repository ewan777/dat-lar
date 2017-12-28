@extends('layouts.app')
@section('content')

<div class="row">
<div class="col-md-6 col-md-offset-3">

  <h1 class="text-center">
    Inbox
    <small>[{{ count($messages)}}] Messages</small>
  </h1>
  <hr>

  <a class="btn btn-link" href="{{ route('member_page') }}">[back]</a>

  <ul class="list-group">
    @foreach ($messages as $message)
      <li class="list-group-item">
        <strong>To: </strong>{{ $message->receiver }} --
        <strong>From: </strong>{{ $message->sender }}

        @if(!is_null($message->replying_to_body))
        <br>
        <strong>Regarding Message: </strong>[ {{ $message->replying_to_title }} -- {{ $message->replying_to_body }} ]
        @endif
        <br>
        <strong>Title: </strong>[ {{ $message->title }} ] <br>
        <strong>Message: </strong>[ {{ $message->body }} ]<br>
        @if(Auth::user()->id == $message->receiver_id)
          <a href="{{ route('get_reply', $message->id) }}">[Reply]</a>
        @endif
      </li>
    @endforeach
  </ul>

</div>
</div>

@endsection
