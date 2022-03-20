<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ApiTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function testBasicCallApi()
    {
        $response = $this->get('/');

        $response->assertStatus(200);
    }

    public function testValidCard()
    {

        $dataArr = [
            'client_id' => '123',
            'buyer_name' => 'Snow',
            'buyer_email' => 'snow@mail.com',
            'amount' => 3000,
            'card_holder_name' => 'Snow S.',
            'card_number' => '4242424242424242',
            'card_expire_month' => '3',
            'card_expire_year' => '23',
            'card_cvc' => '123',
        ];

        $response = $this->json('POST', '/api/checkout', $dataArr);

        $response
            ->assertStatus(200)
            ->assertJson([
                'payment_status' => 'succeeded',
            ]);
    }

    public function testInValidCard()
    {

        $dataArr = [
            'client_id' => '123',
            'buyer_name' => 'Snow',
            'buyer_email' => 'snow@mail.com',
            'amount' => 3000,
            'card_holder_name' => 'Snow S.',
            'card_number' => '4000000000009995',
            'card_expire_month' => '3',
            'card_expire_year' => '23',
            'card_cvc' => '123',
        ];

        $response = $this->json('POST', '/api/checkout', $dataArr);

        $response
            ->assertStatus(200)
            ->assertJson([
                'payment_status' => 'failed',
            ]);
    }
}
