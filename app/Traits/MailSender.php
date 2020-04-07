<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace App\Traits;

use App\Mail\AppraisalRequestNotificationEmail;
use Illuminate\Mail\Mailable;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;

/**
 * Description of MailSender
 *
 * @author jahangir
 */
trait MailSender
{
    public function EmailNotificationValues($submittedTo, $submittedBy, $msg, $url)
    {
        $submittedToPerson = $submittedTo;
        $submittedByPerson = $submittedBy;
        $message = $msg;
        $route = $url;
        $toEmailAddress = $submittedToPerson->email;
        $toEmailName = "জনাব " . $submittedToPerson->first_name . " " . $submittedToPerson->last_name;
        if (env('USE_SYSTEM_MAIL', true)) {
            $toEmailAddress = env('MAIL_USERNAME');
        }
        $mailable = new AppraisalRequestNotificationEmail($submittedByPerson, $message, $route, $toEmailAddress, $toEmailName);
        $this->sendEmail($toEmailAddress, $mailable);
    }

    public function sendEmail($toAddress, Mailable $mailable)
    {
        try {
            Mail::to($toAddress)->send($mailable);
        } catch (\Exception $ex) {
            Log::error($ex);
        }
    }
}
