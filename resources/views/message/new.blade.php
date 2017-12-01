@extends('layouts.app')
@section('content')

<div class="row">
<div class="col-md-6 col-md-offset-3">
  <h1 class="text-center">
    Send New Message
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

  <form class="form" action="{{ route('send_message') }}" method="post">
    {{ csrf_field() }}

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


</div>
</div>

@endsection
