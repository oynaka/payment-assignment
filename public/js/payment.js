$(function () {
    var formElement = $('#payment-form');
    var csrfTokenElement = $('meta[name="csrf-token"]');

    formElement.submit(function (e) {
        e.preventDefault();
        $('#submitBtn').hide();
        $('#loadingBtn').show();
        var postData = formElement.serializeArray();

        $.ajax({
            method: 'POST',
            url: 'http://localhost:8082/api/checkout',
            headers: {
                'Content-Typ': 'application/json',
                'X-CSRF-TOKEN': csrfTokenElement ? csrfTokenElement.attr('content') : ''
            },
            data: postData
        }).done(function (result) {

            $('#loadingBtn').hide();
            $('#submitBtn').show();
            
            var resultObj = result;
            console.log(resultObj);

            var htmlTxt = "";

            if(resultObj.payment_status == 'succeeded') {
                htmlTxt += "<div class=\"alert alert-success\" role=\"alert\">Payment succeeded!</div>";
            } else {
                htmlTxt += "<div class=\"alert alert-danger\" role=\"alert\">Your payment was not successful, please try again.</div>";
            }
            htmlTxt += "Client ID : " + resultObj.params['client_id'];
            htmlTxt += "<br>Client Name : " + resultObj.params['buyer_name'];
            htmlTxt += "<br>Client Email : " + resultObj.params['buyer_email'];
            htmlTxt += "<br>Amount to pay : " + resultObj.params['amount'];

            htmlTxt += "<br>Card Holder Name : " + resultObj.params['card_holder_name'];
            htmlTxt += "<br>Card Number : " + resultObj.params['card_number'];
            htmlTxt += "<br>Card Expiration Date : " + resultObj.params['card_expire_month'] + "/" + resultObj.params['card_expire_year'];
            htmlTxt += "<br>CVC : " + resultObj.params['card_cvc'];

            $('.modal-body').html(htmlTxt);
            $('#resultModal').modal('show');


            // window.location.href = "/success";
        }).fail(function (result) {
            console.log(result);
        });
    });
});
