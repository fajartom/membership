<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class TokenNumber extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($data)
    {
        $this->data = $data;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->from('fajarqibs@gmail.com', 'Admin Ngefans')
            ->subject('Register Confirmation')
            ->markdown('email.token')
            ->with([
                'name' => $this->data['name'],
                'code' => $this->data['code']
            ]);
    }
}