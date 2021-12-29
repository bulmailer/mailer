<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class MailMark extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    private $from_add;
    protected $mail;
    protected $mail_subject;
    protected $company_name;
    public function __construct($from, $mail, $mail_subject, $company_name)
    {
        $this->from_add = $from;
        $this->mail = $mail;
        $this->mail_subject = $mail_subject;
        $this->company_name = $company_name;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->from($this->from_add)->subject($this->mail_subject)->markdown('emails.mailhtml', [
            'mail' => $this->mail,
            'subject' => $this->mail_subject,
            'company_name' => $this->company_name
        ]);
    }
}
