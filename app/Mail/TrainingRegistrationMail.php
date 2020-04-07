<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;
use Modules\TMS\Entities\Trainee;

class TrainingRegistrationMail extends Mailable
{
    use Queueable, SerializesModels;
    private $trainee;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(Trainee $trainee)
    {
        $this->trainee = $trainee;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $trainingTitle = $this->trainee->training->training_title;
        return $this->view('emails.training.registration')->with([
            'trainee' => $this->trainee,
            'training_title' => $trainingTitle
        ]);
    }
}
