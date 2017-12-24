@extends('layouts.email')
@section('content')

<div class="row">
<div class="col-md-6 col-md-offset-3">
  <h1 class="text-center">
     <h1>Dear {{ $user->username }}, Your Payment Has Been Received.</h1>
  </h1>
  <hr>

  <p class="lead">
    Your payment id is {{ $user->membership->payment_id }}. Please note your membership expires {{$user->membership->expires}}.
  </p>

</div>
</div>

@endsection
