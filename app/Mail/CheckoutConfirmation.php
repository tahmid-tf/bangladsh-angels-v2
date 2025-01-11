<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class CheckoutConfirmation extends Mailable
{
    use Queueable, SerializesModels;

    public $plan;
    public $billingDetails;

    /**
     * Create a new message instance.
     */
    public function __construct($user, $plan, $price)
    {
        $this->user = $user;
        $this->plan = $plan;
        $this->price = $price;
    }

    /**
     * Build the message.
     */
    public function build()
    {
        return $this->subject('Your Payment Confirmation')
                    ->view('emails.checkout_confirmation')
                    ->with([
                        'user' => $this->user,
                        'plan' => $this->plan,
                        'price' => $this->price,
                    ]);
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Checkout Confirmation',
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
