<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class SendMyEmail extends Mailable
{
    use Queueable, SerializesModels;

    public $data = '';

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($toView)
    {
        //This public property will be available to the view.
        $this->data = $toView;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('mail');
    }
}
