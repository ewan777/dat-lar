@extends('layouts.app')
@section('content')

<div class="row">
<div class="col-md-6 col-md-offset-3">
  <h1 class="text-center">
    Register
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

  <form class="form" action="{{ route('user.register') }}" method="post">
    {{ csrf_field() }}

    <div class="form-group">
      <label for="name">Full Name (not displayed)</label>
      <input class="form-control" type="text" name="name" id="name">
    </div>

    <div class="form-group">
      <label for="username">Username</label>
      <input class="form-control" type="text" name="username" id="username">
    </div>

    <div class="form-group">
      <label for="sex">Gender</label>
      <select class="form-control" name="sex" id="sex">
        <option>male</option>
        <option>female</option>
      </select>
    </div>

    <div class="form-group">
      <label for="email">Email (not displayed)</label>
      <input class="form-control" type="email" name="email" id="email">
    </div>

    <div class="form-group">
      <label for="password">Password</label>
      <input class="form-control" type="password" name="password" id="password">
    </div>

    <div class="form-group">
      <label for="password_confirmation">Confirm Password</label>
      <input class="form-control" type="password" name="password_confirmation" id="password_confirmation">
    </div>

    <button class="btn btn-success btn-block" type="submit" name="button">Submit</button>

  </form>

  <a style="padding-left: 0;" class="btn btn-primary btn-link" href="{{ route('user.resend_activation') }}">Resend Activation Email</a>


</div>
</div>

@endsection
