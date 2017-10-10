@extends('layouts.app')
@section('content')

<div class="row">
<div class="col-md-6 col-md-offset-3">
  <h1 class="text-center">
    Become A Privileged Member
  </h1>
  <hr>

  <form class="form" action="{{ route('payment') }}" method="post" id="payment-form">
    {{ csrf_field() }}

    <div class="form-group">
      <label for="card-name">Card Holder Name</label>
      <input class="form-control" type="text" id="card-name" required>
    </div>

    <div class="form-group">
      <label for="card-number">Card Number</label>
      <input class="form-control" type="text" id="card-number" required>
    </div>

    <div class="row">
      <div class="col-xs-6">
        <div class="form-group">
          <label for="card-expiry-month">Expiry Month [xx]</label>
          <input class="form-control" type="text" id="card-expiry-month" required>
        </div>
      </div>
      <div class="col-xs-6">
        <div class="form-group">
          <label for="card-expiry-month">Expiry Year [xxxx]</label>
          <input class="form-control" type="text" id="card-expiry-month" required>
        </div>
      </div>
    </div>

    <div class="row">
      <div class="col-xs-4">
        <div class="form-group">
          <label for="card-cvc">CVC [xxx]</label>
          <input class="form-control" type="text" id="card-cvc" required>
        </div>
      </div>
    </div>

    <button class="btn btn-success btn-block" type="submit" name="button">Submit Payment</button>

  </form>

</div>
</div>

@endsection



@section('scripts')
  <script src="https://js.stripe.com/v3/"></script>
  <script src="{{ URL::to('src/js/payment.js') }}"></script>
@endsection
