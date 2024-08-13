<?php 

namespace App\Stripe;

use App\Entity\Purchase;

class StripeService 
{
    protected $secretKey;
    protected $publicKey;

    public function __construct(string $secretKey, string $publicKey)
    {
        $this->secretKey = $secretKey;
        $this->publicKey = $publicKey;
    }

    public function getPublicKey(): string {
        return $this->publicKey;
    }

    public function getPaymentIntent(Purchase $purchase) {
        $stripeSecretKey = $this->secretKey;

        $stripe = new \Stripe\StripeClient($stripeSecretKey);

        return $stripe->paymentIntents->create([
            'amount' => $purchase->getTotal(),
            'currency' => 'eur',
            'automatic_payment_methods' => [
                'enabled' => true,
            ],
        ]);
    }
}