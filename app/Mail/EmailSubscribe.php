<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class EmailSubscribe extends Mailable
{
    use Queueable, SerializesModels;

    public $app_url;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($conf_code, $email)
    {
        $this->app_url = getenv('APP_URL') . '/confirm?code=' . $conf_code . '&email=' . $email;

    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject('Mailing List Confirmation')->markdown('Email.EmailSubscribe');
    }
}
