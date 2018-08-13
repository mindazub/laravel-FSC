<?php
declare(strict_types = 1);

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

/**
 * Class ContactMessage
 * @package App\Mail
 */
class ContactMessage extends Mailable
{
    use Queueable, SerializesModels;
    /**
     * @var string
     */
    private $fullName;
    /**
     * @var string
     */
    private $email;
    /**
     * @var string
     */
    private $message;

    /**
     * Create a new message instance.
     *
     * @param string $fullName
     * @param string $email
     * @param string $message
     */
    public function __construct(string $fullName, string $email, string $message)
    {
        //
        $this->fullName = $fullName;
        $this->email = $email;
        $this->message = $message;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build(): ContactMessage
    {
        return $this
            ->to('mindaugas.azubalis@gmail.com')
            ->from($this->email, $this->fullName)
            ->subject('New contact request')
            ->view('emails.contact_message')
            ->with([
                'name' => $this->fullName,
                'email' => $this->email,
                'content' => $this->message,
            ]);
    }
}
