<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8" />
    <title>Accept a payment</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="description" content="A demo of a payment on Stripe" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    {{-- <link href="{{asset('css/checkout.css')}}" rel="stylesheet" type="text/css">
    
    <script src="{{asset('js/checkout.js')}}" defer></script> --}}
    <script src="https://js.stripe.com/v3/"></script>
    <link href="{{asset('bootstrap5/css/bootstrap.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{asset('css/custom.css')}}" rel="stylesheet" type="text/css" />
  </head>
  <body>
    <div class="page-container">
      <div class="card payment-form-container">
        <div class="card-body">
          <form id="payment-form">
            @csrf
            <div class="container">
              <div class="row">
                <div class="col col-12 col-md-6">
                  <div class="col col-12">
                    <div class="mb-3">
                      <label for="clientID" class="form-label">Client ID *</label>
                      <input type="text" name="client_id" class="form-control" id="clientID" value="4321" />
                    </div>
                  </div>
                  <div class="col col-12">
                    <div class="mb-3">
                      <label for="clientName" class="form-label">Your name *</label>
                      <input type="text" name="buyer_name" class="form-control" id="clientName" value="Client Name" />
                    </div>
                  </div>
                  <div class="col col-12">
                    <div class="mb-3">
                      <label for="clientEmail" class="form-label">Email address *</label>
                      <input type="email" name="buyer_email" class="form-control" id="clientEmail" placeholder="name@example.com" value="test@email.com" />
                    </div>
                  </div>
                  <div class="col col-12">
                    <div class="mb-3">
                      <label for="amountToPay" class="form-label">Amount to pay*</label>
                      <input type="number" name="amount" class="form-control" id="amountToPay" value="99000">
                    </div>
                  </div>
                </div>
                <div class="col col-12 col-md-6">
                  <div class="row">
                    <div class="col col-12">
                      <div class="mb-3">
                        <label for="cardHolderName" class="form-label">Card Holder Name *</label>
                        <input type="text" name="card_holder_name" class="form-control" id="cardHolderName" value="CARD HOLDER NAME" />
                      </div>
                    </div>
                    <div class="col col-12">
                      <div class="mb-3">
                        <label for="cardNumber" class="form-label">Card Number *</label>
                        <input type="text" name="card_number" class="form-control" id="cardNumber" value="4242424242424242" />
                      </div>
                    </div>
                    <div class="col col-md-7">
                      <div class="mb-3">
                        <label class="form-label">Card Expiration Date *</label>
                        <div class="d-flex align-items-center">
                          <input type="text" name="card_expire_month" class="form-control" id="expMonth" placeholder="1-12" maxlength="2" value="6" />
                          &nbsp;/&nbsp;
                          <input type="text" name="card_expire_year" class="form-control" id="expYear" placeholder="22-99" minlength="2" maxlength="2" value="26" />
                        </div>
                      </div>
                    </div>
                    <div class="col col-md-5">
                      <div class="mb-3">
                        <label for="cvcNumber" class="form-label">CVC *</label>
                        <input type="text" name="card_cvc" class="form-control" id="cvcNumber" minlength="3" maxlength="3" value="123" />
                      </div>
                    </div>
                    <div class="col col-12">
                      <div class="mb-3">
                        <label class="form-label">&nbsp;</label>
                        <div class="d-flex justify-content-end">
                          <button type="submit" id="submitBtn" class="btn btn-primary">Checkout</button>
                          <button class="btn btn-primary" id="loadingBtn" style="display: none" type="button" disabled>
                            <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
                            Loading...
                          </button>
                        </div>
                      </div>
                    </div>
                  </div>
                  
                </div>
                
              </div>
            </div>
          </form>
        </div>
      </div>
    </div>


  <!-- Modal -->
  <div class="modal fade" id="resultModal" tabindex="-1" aria-labelledby="resultModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-body">
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-sm btn-secondary" data-bs-dismiss="modal">Close</button>
        </div>
      </div>
    </div>
  </div>

    <script
      src="https://code.jquery.com/jquery-3.6.0.min.js"
      integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4="
      crossorigin="anonymous"></script>
    <script src="{{asset('bootstrap5/js/bootstrap.min.js')}}" ></script>
    <script src="{{asset('js/payment.js')}}" ></script>
  </body>
</html>