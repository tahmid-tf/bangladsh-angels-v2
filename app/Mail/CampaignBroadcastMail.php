<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Support\Str;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Symfony\Component\Mime\Email;
use Symfony\Component\Mime\Part\DataPart;

class CampaignBroadcastMail extends Mailable
{
    use Queueable, SerializesModels;

    public function __construct(
        public string $campaignSubject,
        public string $campaignHtml,
        public array $attachments = []
    ) {}

    public function build(): self
    {
        [$preparedHtml, $inlineImages] = $this->prepareInlineImages($this->campaignHtml);

        return $this
            ->subject($this->campaignSubject)
            ->view('emails.campaign-broadcast')
            ->with([
                'campaignHtml' => $preparedHtml,
            ])
            ->withSymfonyMessage(function (Email $message) use ($inlineImages): void {
                foreach ($inlineImages as $image) {
                    $part = new DataPart(
                        body: $image['binary'],
                        filename: $image['filename'],
                        contentType: $image['mime']
                    );
                    $part->setContentId($image['cid']);
                    $part->asInline();
                    $message->addPart($part);
                }
            });

        foreach ($this->attachments as $attachment) {
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

    /**
     * @return array{0:string,1:array<int,array{cid:string,binary:string,mime:string,filename:string}>}
     */
    private function prepareInlineImages(string $html): array
    {
        $inlineImages = [];

        $updatedHtml = preg_replace_callback(
            '/src=(["\'])(data:image\/[^"\']+)\1/i',
            function (array $matches) use (&$inlineImages): string {
                $dataUri = $matches[2];
                if (! str_contains($dataUri, ';base64,')) {
                    return $matches[0];
                }

                [$meta, $encoded] = explode(';base64,', $dataUri, 2);
                $mime = str_replace('data:', '', $meta);
                $binary = base64_decode($encoded, true);

                if ($binary === false) {
                    return $matches[0];
                }

                $extension = $this->mimeToExtension($mime);
                $cid = 'banimg-'.Str::uuid()->toString();

                $inlineImages[] = [
                    'cid' => $cid,
                    'binary' => $binary,
                    'mime' => $mime,
                    'filename' => 'campaign-inline.'.$extension,
                ];

                return 'src="cid:'.$cid.'"';
            },
            $html
        );

        return [$updatedHtml ?? $html, $inlineImages];
    }

    private function mimeToExtension(string $mime): string
    {
        return match (strtolower($mime)) {
            'image/jpeg', 'image/jpg' => 'jpg',
            'image/png' => 'png',
            'image/gif' => 'gif',
            'image/webp' => 'webp',
            'image/svg+xml' => 'svg',
            default => 'img',
        };
    }
}
