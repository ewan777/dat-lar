@extends('layouts.app')
@section('content')

<div class="row">
<div class="col-md-6 col-md-offset-3">
  <h1 class="text-center">
    Login
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

  <form class="form" action="{{ route('user.login') }}" method="post">
    {{ csrf_field() }}

    <div class="form-group">
      <label for="email">Email (not displayed)</label>
      <input class="form-control" type="email" name="email" id="email">
    </div>

    <div class="form-group">
      <label for="password">Password</label>
      <input class="form-control" type="password" name="password" id="password">
    </div>

    <button class="btn btn-success btn-block" type="submit" name="button">Login</button>

  </form>

  <a style="padding-left:0;" class="btn btn-link" href="{{ route('user.resend_activation') }}">Resend Activation Email</a><br>

  <a style="padding-left:0; position:relative; bottom:10px;" class="btn btn-link" href="{{ route('user.reset_password') }}">Reset Password</a>


</div>
</div>

@endsection
