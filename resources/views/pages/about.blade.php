@extends('layouts.app')

@section('content')

<div class="row">
<div class="col-md-8">
  <h1 class="text-center">
    {{ $title }}
  </h1>
  <hr>
  <p class="lead">
    this is the {{ $title }} page
  </p>
</div>
</div>

@endsection
