@extends('layouts.app')
@section('content')

<div class="row">
<div class="col-md-8">
  <h1 class="text-center">
    Your Profile ** Welcome
    @if (Auth::user())
      {{ Auth::user()->username }} **
    @endif
  </h1>
  <hr>
  <p class="lead">
    This is your new profie fell free to add pics
  </p>
</div>
</div>

@endsection
