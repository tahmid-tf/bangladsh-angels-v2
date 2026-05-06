<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class CampaignBroadcastMail extends Mailable
{
    use Queueable, SerializesModels;

    public function __construct(
        public string $campaignSubject,
        public string $campaignMessage
    ) {}

    public function build(): self
    {
        return $this
            ->subject($this->campaignSubject)
            ->view('emails.campaign-broadcast')
            ->with([
                'campaignMessage' => $this->campaignMessage,
            ]);
    }
}
