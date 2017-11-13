@extends('layouts.email')
@section('content')

<div class="row">
<div class="col-md-6 col-md-offset-3">
  <h1 class="text-center">
     <h1>Hi {{ $username }}, your membership has expired</h1>
  </h1>
  <hr>

  <p class="lead">
    Please login and click on the "join" link to renew your membership
  </p>

  <a href="{{ route('user.login') }}">
    Renew Your Membership
  </a>

</div>
</div>

@endsection
