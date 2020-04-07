<?php
/**
 * Created by PhpStorm.
 * User: bs110
 * Date: 2/5/19
 * Time: 6:38 PM
 */

namespace App\Services\Notification\Generators;


use App\Entities\Notification\NotificationType;
use App\Entities\User;
use App\Mail\WorkflowEmailNotification;
use App\Models\NotificationInfo;
use App\Services\Notification\AppNotificationService;
use App\Services\Notification\EmailNotifiable;
use App\Services\Notification\SystemNotifiable;
use App\Services\UserService;
use App\Traits\MailSender;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\Mail;
use Modules\PMS\Emails\WorkflowNotificationEmail;
use Modules\PMS\Entities\ProjectProposal;
use Modules\PMS\Services\ProjectProposalService;

class ProjectProposalNotificationGenerator extends BaseNotificationGenerator implements SystemNotifiable, EmailNotifiable
{
    use MailSender;

    private $appNotificationService;
    private $userService;
    private $projectProposalService;

    /**
     * ProjectProposalNotificationGenerator constructor.
     * @param AppNotificationService $appNotificationService
     * @param ProjectProposalService $projectProposalService
     * @param UserService $userService
     */
    public function __construct(
        AppNotificationService $appNotificationService,
        ProjectProposalService $projectProposalService,
        UserService $userService
    )
    {
        $this->appNotificationService = $appNotificationService;
        $this->userService = $userService;
        $this->projectProposalService = $projectProposalService;
    }

    public function notify(NotificationInfo $notificationInfo, NotificationType $notificationType)
    {
        $notificationData = $notificationInfo->getDynamicValues()['notificationData'];
        $notificationData['type_id'] = $notificationType->id;
        $recipients = $this->fetchRecipients($notificationData['ref_table_id'], $notificationInfo->getDynamicValues()['event']);

        foreach ($recipients as $recipient) {
            $notificationData['to_user_id'] = $recipient['id'];
            $this->saveAppNotification($notificationData);
        }
    }

    public function saveAppNotification($data)
    {
        return $this->appNotificationService->save($data);
    }

    public function fetchRecipients($proposalId, $event)
    {
        $recipients = config('constants.' . $event);
        $usersByKeys = [];
        if ($key = array_search('initiator', $recipients) !== false) {
            unset($recipients[$key]);
            $proposal = $this->projectProposalService->findOne($proposalId);
            $usersByKeys = $proposal->proposalSubmittedBy->getAttributes();
        }
        $users = $this->userService->getUserForNotificationSend($recipients);
        count($usersByKeys) ? array_push($users, $usersByKeys) : '';

        return $users;
    }

    public function sendEmailNotification($data)
    {
        $user = $this->userService->findOne($data['user_id']);

        $this->sendEmail($user->email, new WorkflowEmailNotification($data['title'], $data['message'], $data['url']));
    }

    /**
     * @param NotificationInfo $notificationInfo
     * @return mixed
     */
    private function getProjectProposalId(NotificationInfo $notificationInfo)
    {
        return $notificationInfo->dynamicValues['notificationData']['ref_table_id'];
    }

    /**
     * @param NotificationInfo $notificationInfo
     * @return mixed
     */
    private function getNotificationMessage(NotificationInfo $notificationInfo)
    {
        return $notificationInfo->dynamicValues['notificationData']['message'];
    }
}
