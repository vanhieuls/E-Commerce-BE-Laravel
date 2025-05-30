<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class VerifyEmail extends Mailable
{
    use Queueable, SerializesModels;

    public $name;
    public $verificationUrl;

    /**
     * Create a new message instance.
     *
     * @param array $userData
     * @param string $verificationUrl
     * @return void
     */
    public function __construct($userData, $verificationUrl)
    {
        $this->name = $userData['name'] ?? 'Khách Hàng';
        $this->verificationUrl = $verificationUrl;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject('Xác Minh Địa Chỉ Email Của Bạn')
                    ->priority(1) // High priority
                    // This line connects to the actual blade template
                    ->view('emails.verify-email')
                    ->with([
                        'name' => $this->name,
                        'verificationUrl' => $this->verificationUrl,
                    ]);
    }
}