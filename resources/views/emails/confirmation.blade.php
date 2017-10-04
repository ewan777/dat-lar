@extends('layouts.email')
@section('content')

<div class="row">
<div class="col-md-6 col-md-offset-3">
  <h1 class="text-center">
     <h1>Confirmation Email</h1>
  </h1>
  <hr>

  <p class="lead">
    Please confirm your email by clicking on the following link:
  </p>

  <a href="{{ url('user/registered').'/'.$confirmation_code  }}">
    Confirm Your Account
  </a>

</div>
</div>

@endsection
