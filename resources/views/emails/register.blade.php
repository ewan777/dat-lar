@extends('layouts.email')
@section('content')

<div class="row">
<div class="col-md-6 col-md-offset-3">
  <h1 class="text-center">
     <h1>Registration Email</h1>
  </h1>
  <hr>

  <p class="lead">
    Complete your registration by clicking the following link:
  </p>

  <a href="{{ url('user/registered').'/'.$confirmation_code  }}">
    Complete your registration
  </a>

</div>
</div>

@endsection
