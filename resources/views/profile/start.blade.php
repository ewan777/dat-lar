@extends('layouts.app')
@section('content')

<div class="row">
<div class="col-md-6 col-md-offset-3">
  <h1 class="text-center">  
    Welcome {{ Auth::user()->username }}
  </h1>

  <hr>
  <p class="lead text-center">
    Click The Button Below To Start Creating Your Profile
  </p>

  <a class="btn btn-success btn-block" href="{{ route('profile.new') }}">Start Profile</a>

</div>
</div>

@endsection
