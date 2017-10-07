@extends('layouts.app')
@section('content')

<div class="row">
<div class="col-md-6 col-md-offset-3">
  <h1 class="text-center">
    Request Password Reset Email
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

  <form class="form" action="{{ route('user.reset_password') }}" method="post">
    {{ csrf_field() }}

    <div class="form-group">
      <label for="email">Email</label>
      <input class="form-control" type="email" name="email" id="email">
    </div>

    <button class="btn btn-success btn-block" type="submit" name="button">Reset Password</button>

  </form>

</div>
</div>

@endsection
