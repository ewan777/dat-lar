@extends('layouts.app')
@section('content')

<div class="row">
<div class="col-md-6 col-md-offset-3">

  <h1 class="text-center">
    Outbox
    <small>[{{ count($messages)}}] Messages</small>
  </h1>
  <hr>

  <a class="btn btn-link" href="{{ route('member_page') }}">[back]</a>

  <ul class="list-group">
    @foreach ($messages as $n => $message)
      <li class="list-group-item">
        <strong>Message:<strong> {{ $n + 1}}&nbsp;-
        <strong>To: <strong>{{ $message->receiver}} <br>
        <strong>Title: <strong>[ {{ $message->title }} ] <br>
        <strong>Message: <strong>[ {{ $message->body }} ]<br>
        <a href="#">[Reply]</a>
      </li>
    @endforeach
  </ul>

</div>
</div>

@endsection
