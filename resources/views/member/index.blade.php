@extends('layouts.app')
@section('content')

<div class="row">
<div class="col-md-8">
  <h1 class="text-center">Member's Area
  <small>Welcome {{$profile->username}}</small>
  </h1>
  <hr>
  <p class="lead">
    You can now send messages and converse with the guests
  </p>

  <ul class="list-group">
    @foreach($user_profiles as $user)
      <li class="list-group-item">
        <strong>Username:</strong> {{ $user->username }} <br>
        <strong>Age Group:</strong> {{ $user->age_group }}<br>
        <a class="btn btn-success btn-xs" href="{{ route('profile', $user->id) }}">View Profile</a>
      </li>
    @endforeach
  </ul>

  {{-- <p>
    <a class="btn btn-success btn-lg" href="{{ route('new_message') }}">Send Message</a>
  </p> --}}

</div>
</div>

@endsection
