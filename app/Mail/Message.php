<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;


class Message extends Mailable
{
use Queueable, SerializesModels;

/**
* Create a new message instance.
*
* @return void
*/ protected $message_data= "";
public function __construct($message_data_from_con)
{
  $this->message_data = $message_data_from_con;
}

/**
* Build the message.
*
* @return $this
*/
public function build()
{
        $message_data_final= $this->message_data;
        return $this->view('mail.Message',compact('message_data_final'));
}


}