<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class CampaignBroadcastMail extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * @var array<int, array{filename:string,mime:string,data:string}>
     */
    protected array $campaignAttachments;

    public function __construct(
        public string $campaignSubject,
        public string $campaignHtml,
        array $attachments = []
    ) {
        $this->campaignAttachments = $attachments;
    }

    public function build(): self
    {
        $preparedHtml = $this->removeInlineImageTags($this->campaignHtml);

        $mail = $this
            ->subject($this->campaignSubject)
            ->view('emails.campaign-broadcast')
            ->with([
                'campaignHtml' => $preparedHtml,
            ]);

        foreach ($this->campaignAttachments as $attachment) {
            $binary = base64_decode((string) ($attachment['data'] ?? ''), true);
            if ($binary === false) {
                continue;
            }

            $mail->attachData(
                $binary,
                (string) ($attachment['filename'] ?? 'attachment'),
                ['mime' => (string) ($attachment['mime'] ?? 'application/octet-stream')]
            );
        }

        return $mail;
    }

    private function removeInlineImageTags(string $html): string
    {
        $withoutDataImages = preg_replace('/<img\b[^>]*\bsrc=(["\'])data:image\/[^"\']+\1[^>]*>/i', '', $html) ?? $html;
        return preg_replace('/<img\b[^>]*\bsrc=(["\'])cid:[^"\']+\1[^>]*>/i', '', $withoutDataImages) ?? $withoutDataImages;
    }
}
