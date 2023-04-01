<?php

namespace App\Jobs;

use App\Services\Webhooks\Payment\ReceiptDTO;
use Spatie\WebhookClient\Jobs\ProcessWebhookJob;
use Spatie\WebhookClient\Models\WebhookCall;

class PaymentProcessWebhookJob extends ProcessWebhookJob
{
    public function __construct(WebhookCall $webhookCall)
    {
        parent::__construct($webhookCall);

        $this->onConnection(config('queue.webhooks.connection'))
            ->onQueue(config('queue.webhooks.name'));
    }

    public function handle(): void
    {
        $receipt = ReceiptDTO::fromWebhookCall($this->webhookCall);

        // TODO: $receipt->getUrl() some actions with receipt url
    }
}
