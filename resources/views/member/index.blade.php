@extends('layouts.app')
@section('content')

<h1 class="text-center">Member's Area
  <small>Welcome {{$profile->username}}</small>
</h1>
<hr>
<p class="text-center lead">
  You can now send messages and converse with the guests
</p>

<div class="row">
<div class="col-md-6">

  <ul class="list-group">
    @foreach($user_profiles as $user)
      <li class="list-group-item">
        <strong>Username:</strong> {{ $user->username }} <br>
        <strong>Age Group:</strong> {{ $user->age_group }}<br>
        <a class="btn btn-success btn-xs" href="{{ route('profile', $user->id) }}">View Profile</a>
      </li>
    @endforeach
  </ul>
</div> <!-- end cols -->

<div class="col-md-6">
  <a class="btn btn-primary" href="{{ route('my_messages', Auth::user()->id) }}">Inbox</a>

  <a class="btn btn-success" href="{{ route('sent_messages', Auth::user()->id) }}">Outbox</a>
</div> <!-- end cols -->

</div> <!-- end row -->

@endsection
