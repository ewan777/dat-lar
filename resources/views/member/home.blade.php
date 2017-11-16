@extends('layouts.app')
@section('content')

<div class="row">
<div class="col-md-8">
  <h1 class="text-center">Member's Area
    <small>Welcome {{ Auth::user()->username }}</small>
  </h1>  
  <hr>
  <p class="lead">
    You can now send messages and converse with the guests
  </p>
</div>
</div>

@endsection
