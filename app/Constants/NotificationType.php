<?php
/**
 * Created by PhpStorm.
 * User: jahangir
 * Date: 1/29/19
 * Time: 12:15 PM
 */

namespace App\Constants;


abstract class NotificationType
{
    const RESEARCH_PROPOSAL_SUBMISSION = 'Research Proposal Notification';
    const PROJECT_PROPOSAL_SUBMISSION = 'Project Proposal Submission';
    const IMS_WORKFLOW = 'IMS WORKFLOW';
    const ACR_REQUEST = 'ACR Request Notification';
    const ACR_REQUEST_EVALUATION_SUBMIT = 'ACR Request Evaluation Submitted';
}
