<?php

namespace App\Jobs;

use App\Mail\CampaignBroadcastMail;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\Middleware\RateLimited;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Mail;

class SendCampaignEmailJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public int $tries = 5;

    /**
     * @var array<int, int>
     */
    public array $backoff = [15, 60, 180, 600];

    public function __construct(
        public string $recipientEmail,
        public string $subject,
        public string $htmlBody,
        public array $attachments = []
    ) {
        $this->onQueue('mail-campaigns');
    }

    public function middleware(): array
    {
        return [
            new RateLimited('campaign-mails'),
        ];
    }

    public function handle(): void
    {
        Mail::to($this->recipientEmail)->send(
            new CampaignBroadcastMail($this->subject, $this->htmlBody, $this->attachments)
        );
    }
}
