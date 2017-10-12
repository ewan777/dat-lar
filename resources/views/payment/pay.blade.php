@extends('layouts.app')
@section('content')

<div class="row">
<div class="col-md-6 col-md-offset-3">
  <h1 class="text-center">
    Become A Privileged Member
  </h1>
  <p class="text-center">Stripe Secure Payment - Your Card Details Are NOT Stored</p>
  <hr>

  <div id="charge_error" class="alert alert-danger alert-dismissable text-center {{ !Session::has('error') ? 'hidden' : '' }}">
    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
    {{ Session::get('error') }}
  </div>

  <form class="form" action="{{ route('payment') }}" method="post" id="payment_form">
    {{ csrf_field() }}

    <div class="form-group">
      <label for="card-name">Card Holder Name</label>
      <input class="form-control" type="text" id="card-name" data-stripe="name" required>
    </div>

    <div class="form-group">
      <label for="card-number">Card Number</label>
      <input class="form-control" type="text" id="card-number" data-stripe="number" required>
    </div>

    <div class="row">
      <div class="col-xs-6">
        <div class="form-group">
          <label for="card-expiry-month">Expiry Month</label>
          <input class="form-control" type="text" id="card-expiry-month" data-stripe="exp_month" required placeholder="MM">
        </div>
      </div>
      <div class="col-xs-6">
        <div class="form-group">
          <label for="card-expiry-year">Expiry Year</label>
          <input class="form-control" type="text" id="card-expiry-year" data-stripe="exp_year" required placeholder="YYYY">
        </div>
      </div>
    </div>

    <div class="row">
      <div class="col-xs-4">
        <div class="form-group">
          <label for="card-cvc">CVC</label>
          <input class="form-control" type="text" id="card-cvc" data-stripe="cvc" required placeholder="XXX">
        </div>
      </div>
    </div>

    <button class="btn btn-success btn-block" type="submit" name="button">Submit Payment</button>

  </form>

</div>
</div>

@endsection

@section('scripts')
  <script type="text/javascript" src="https://js.stripe.com/v2/"></script>
  <script src="{{ asset('js/payment.js') }}"></script>
@endsection
