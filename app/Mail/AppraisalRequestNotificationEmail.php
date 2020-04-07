<?php


namespace App\Mail;


use Illuminate\Mail\Mailable;

class AppraisalRequestNotificationEmail extends Mailable
{
    private $message;
    private $name;

    public $from;
    public $to;
    public $subject;

    /**
     * Create a new message instance.
     *
     * @param $submittedByPerson
     * @param $message
     * @param $route
     * @param $toEmailAddress
     * @param $toEmailName
     */

    public function __construct($submittedByPerson, $message, $route, $toEmailAddress, $toEmailName)
    {
        $this->to[0]['name'] = $toEmailName;
        $this->to[0]['address'] = $toEmailAddress;
        $this->from[0]['name'] = "ICT ACR";
        $this->from[0]['address'] = env('MAIL_USERNAME');
        $this->subject = "ACR Notification";
        $this->name = $toEmailName;
        $this->message = $message . ". \r\nSubmitted By: " .
            $submittedByPerson->user->name . ".  \r\nSee the notification here: " . $route;

    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $message = $this->message;
        $name = $this->name;
        return $this->markdown('hrm::notification.email', compact('name', 'message'));
    }

}
