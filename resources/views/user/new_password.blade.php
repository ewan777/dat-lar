@extends('layouts.app')
@section('content')

<div class="row">
<div class="col-md-6 col-md-offset-3">
  <h1 class="text-center">
    Reset Password
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

  <form class="form" action="{{ route('user.new_password') }}" method="post">
    {{ csrf_field() }}

    <input name="user_id" type="hidden" value="{{ $id }}">

    <div class="form-group">
      <label for="password">Password</label>
      <input class="form-control" type="password" name="password" id="password">
    </div>

    <div class="form-group">
      <label for="password_confirmation">Confirm Password</label>
      <input class="form-control" type="password" name="password_confirmation" id="password_confirmation">
    </div>

    <button class="btn btn-success btn-block" type="submit" name="button">Reset Password</button>

  </form>


</div>
</div>

@endsection
