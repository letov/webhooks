<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class PaymentWebhookTest extends TestCase
{
    use RefreshDatabase;

    public function test_it_checks_receive_payment_webhook()
    {
        $webhookPayload = $this->getWebhookPayload(12,'https://someurl.com/receipt.pdf');
        $response = $this->postJson('/api/webhook/payment', $webhookPayload);

        $response->assertOk();
        $this->assertDatabaseCount('webhook_calls', 1);
    }

    private function getWebhookPayload(
        int $orderId,
        string $receiptUrl
    ): array {
        return [
            'order_id' => $orderId,
            'receipt_url' => $receiptUrl,
        ];
    }
}
