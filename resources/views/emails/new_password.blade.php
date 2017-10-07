@extends('layouts.email')
@section('content')

<div class="row">
<div class="col-md-6 col-md-offset-3">
  <h1 class="text-center">
    <h1>Reset Password</h1>
  </h1>
  <hr>

  <p class="lead">
    Use the link below to reset your password
  </p>

  <a href="{{ url('user/new-password').'/'.$reset_code  }}">
    Reset Password Now
  </a>

</div>
</div>

@endsection
