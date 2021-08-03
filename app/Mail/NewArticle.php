<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class NewArticle extends Mailable
{
    use Queueable, SerializesModels;

    public $text, $topic;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($topic, $text)
    {
        $this->topic = $topic;
        $this->text = $text;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject($this->topic)->markdown('Email.NewArticleEmail');
    }
}
