Stripe.setPublishableKey('pk_test_zjZH0DutGyDVW0bmc3KzQHnb');
var $form = $('#payment_form');

$form.submit(function(event) {
    $('#charge_error').addClass('hidden');

    // Disable the submit button to prevent repeated clicks:
    $form.find('button').prop('disabled', true);

    // Request a token from Stripe:
    Stripe.card.createToken({
      name:      $('#card-name').val(),
      number:    $('#card-number').val(),
      exp_month: $('#card-expiry-month').val(),
      exp_year:  $('#card-expiry-year').val(),
      cvc:       $('#card-cvc').val()
    }, stripeResponseHandler);

    // Prevent the form from being submitted:
    return false;
});

function stripeResponseHandler(status, response) {
  if(response.error) {
    $('#charge_error').removeClass('hidden');
    $('#charge_error').text(response.error.message);
    $form.find('button').prop('disabled', false);
  } else {
    var token = response.id;
    $form.append($('<input type="hidden" name="stripeToken">').val(token));

    // submits the form
    $form.get(0).submit();
  }
};
