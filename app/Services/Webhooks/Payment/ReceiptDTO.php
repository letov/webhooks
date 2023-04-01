<?php

namespace App\Services\Webhooks\Payment;

use Spatie\WebhookClient\Models\WebhookCall;

class ReceiptDTO
{
    private int $orderId;
    private string $url;

    public function getOrderId(): int
    {
        return $this->orderId;
    }

    public function getUrl(): string
    {
        return $this->url;
    }

    public static function fromWebhookCall(WebhookCall $webhookCall): self
    {
        $instance = new self();

        $instance->orderId = $webhookCall->payload['order_id'];
        $instance->url = $webhookCall->payload['receipt_url'];

        return $instance;
    }
}
