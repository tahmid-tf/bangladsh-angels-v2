<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;
use App\Models\User;

class AccountApproved extends Mailable
{
    use Queueable, SerializesModels;

    public $user;
    public $logoData;

    /**
     * Create a new message instance.
     */
    public function __construct(User $user)
    {
        $this->user = $user;
        // Base64 encode the logo for inline embedding in the email
        $logoPath = public_path('Logo Base@4x.png');
        $this->logoData = base64_encode(file_get_contents($logoPath));
    }

    /**
     * Build the message.
     */
    public function build()
    {
        return $this->subject('Your Bangladesh Angels Network Account is Approved!')
                    ->view('emails.account_approved')
                    ->with([
                        'user' => $this->user,
                        'logoData' => $this->logoData,
                    ]);
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Your Bangladesh Angels Network Account is Approved!',
        );
    }

    /**
     * Get the attachments for the message.
     *
     * @return array<int, \Illuminate\Mail\Mailables\Attachment>
     */
    public function attachments(): array
    {
        return [];
    }
}