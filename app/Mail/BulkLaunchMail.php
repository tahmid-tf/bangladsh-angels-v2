<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class BulkLaunchMail extends Mailable
{
    use Queueable, SerializesModels;

    public $user;
    public $password;
    /**
     * Create a new message instance.
     */
    public function __construct($user, $password)
    {
        $this->user = $user;
        $this->password = $password;
    }

    public function build()
    {
        return $this->subject('Your BAN Platform Account is Ready – Access Your Investor Dashboard')
                    ->view('emails.investor-account-ready')
                    ->with([
                        'firstName' => $this->user->name,
                        'email' => $this->user->email,
                        'password' => $this->password,
                        'platformLink' => route('login'),
                    ]);
    }


    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Important Exciting Update | Bangladesh Angels Network',
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
