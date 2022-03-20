<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8" />
    <title>Accept a payment</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="description" content="A demo of a payment on Stripe" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <link href="{{asset('css/checkout.css')}}" rel="stylesheet" type="text/css">
    <script src="{{asset('js/checkout.js')}}" defer></script>
    <script src="https://js.stripe.com/v3/"></script>
  </head>
  <body>
    <div class="page-container">
      <div class="card payment-form-container">
        <!-- Display a payment form -->
        <form id="payment-form">
            @csrf
          <div id="payment-element">
            <!--Stripe.js injects the Payment Element-->
          </div>
          <button id="submit">
            <div class="spinner hidden" id="spinner"></div>
            <span id="button-text">Pay now</span>
          </button>
          <div id="payment-message" class="hidden"></div>
        </form>
      </div>
    </div>


  </body>
</html>