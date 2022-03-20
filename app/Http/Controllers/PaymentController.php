<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller as BaseController;
//use Illuminate\Support\Collection;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Config;
use Session;
use View;
use Route;

class PaymentController extends BaseController {
    private $stripe = null;

    public function __construct(Request $request) {
        // This is a public sample test API key.
        // Don’t submit any personally identifiable information in requests made with this key.
        // Sign in to see your own test API key embedded in code samples.
        \Stripe\Stripe::setApiKey('sk_test_4eC39HqLyjWDarjtT1zdp7dc');
        $this->stripe = new \Stripe\StripeClient('sk_test_4eC39HqLyjWDarjtT1zdp7dc');
    }

    public function create(Request $request ) {

        //$params = $request->all();
        //echo '<pre>';print_r($params);echo '</pre>';

        try {
            // retrieve JSON from POST body
            $jsonStr = file_get_contents('php://input');
            $jsonObj = json_decode($jsonStr);
        
            // Create a PaymentIntent with amount and currency
            $paymentIntent = \Stripe\PaymentIntent::create([
                'amount' => $this->calculateOrderAmount($jsonObj->items),
                'currency' => 'eur',
                'automatic_payment_methods' => [
                    'enabled' => true,
                ],
            ]);
        
            $output = [
                'clientSecret' => $paymentIntent->client_secret,
            ];
        
            echo json_encode($output);
        } catch (Error $e) {
            http_response_code(500);
            echo json_encode(['error' => $e->getMessage()]);
        }
    }

    private function calculateOrderAmount(array $items): int {
        // Replace this constant with a calculation of the order's amount
        // Calculate the order total on the server to prevent
        // people from directly manipulating the amount on the client
        return 1400;
    }

    public function checkout(Request $request) {
        $params = $request->all();

        try {

            //create customer
            $customer = $this->stripe->customers->create([
                'name' => $params['buyer_name'],
                'email' => $params['buyer_email']
            ]);

            //create payment method
            $paymentMethod = $this->stripe->paymentMethods->create([
                'type' => 'card',
                'card' => [
                  'number' => $params['card_number'],
                  'exp_month' => $params['card_expire_month'],
                  'exp_year' => $params['card_expire_year'],
                  'cvc' => $params['card_cvc'],
                ],
              ]);

            //attach payment method to customer
            $this->stripe->paymentMethods->attach(
                $paymentMethod->id,
                ['customer' => $customer->id]
            );

            // Create a PaymentIntent with amount and currency
            $paymentIntent = $this->stripe->paymentIntents->create([
                'customer' => $customer->id,
                'amount' => $params['amount'],
                'currency' => 'eur',
                'payment_method_types' => ['card'],
            ]);

            $paymentResult = $this->stripe->paymentIntents->confirm(
                $paymentIntent->id,
                ['payment_method' => 'pm_card_visa']
              );

            $output = [
                'payment_status' => $paymentResult->status,
                'params' => $params
            ];
        
            return response()->json($output);
        } catch (\Stripe\Exception\CardException $e) {

            $output = [
                'payment_status' => 'failed',
                'error_code' => $e->getDeclineCode(),
                'params' => $params
            ];

            return response()->json($output);
            // echo json_encode($output);
        }
        
    }

    //valid
    //4242424242424242
    //4000002760003184

    //invalid
    //4000000000009995

}
