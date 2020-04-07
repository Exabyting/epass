<?php
/**
 * Created by PhpStorm.
 * User: jahangir
 * Date: 2/5/19
 * Time: 6:38 PM
 */

namespace App\Services\Notification\Generators;


use App\Entities\Notification\NotificationType;

use App\Entities\User;
use App\Mail\WorkflowEmailNotification;
use App\Models\NotificationInfo;
use App\Repositories\Notification\NotificationTypeRepository;
use App\Services\Notification\AppNotificationService;
use App\Services\Notification\EmailNotifiable;
use App\Services\Notification\SystemNotifiable;
use App\Services\UserService;
use App\Traits\MailSender;
use const http\Client\Curl\AUTH_ANY;
use Illuminate\Support\Facades\Auth;
use Modules\HRM\Services\DesignationService;
use Modules\PMS\Emails\WorkflowNotificationEmail;
use Modules\PMS\Entities\ProjectProposal;
use Modules\RMS\Entities\ResearchProposalSubmission;
use Modules\RMS\Services\ResearchProposalSubmissionService;
use Prophecy\Doubler\Generator\TypeHintReference;

class ResearchProposalNotificationGenerator extends BaseNotificationGenerator implements SystemNotifiable, EmailNotifiable
{
    use MailSender;

    private $appNotificationService;
    private $notificationTypeRepository;
    private $userService;
    private $researchProposalSubmissionService;


    /**
     * ResearchProposalNotificationGenerator constructor.
     * @param UserService $userService
     * @param AppNotificationService $appNotificationService
     * @param NotificationTypeRepository $notificationTypeRepository
     * @param ResearchProposalSubmissionService $researchProposalSubmissionService
     */
    public function __construct(
        UserService $userService,
        AppNotificationService $appNotificationService,
        NotificationTypeRepository $notificationTypeRepository,
        ResearchProposalSubmissionService $researchProposalSubmissionService
    )
    {
        $this->appNotificationService = $appNotificationService;
        $this->notificationTypeRepository = $notificationTypeRepository;
        $this->researchProposalSubmissionService = $researchProposalSubmissionService;
        $this->userService = $userService;
    }


    public function notify(NotificationInfo $notificationInfo, NotificationType $notificationType)
    {
        $this->saveAppNotification($notificationInfo);
    }

    /**
     * @param NotificationInfo $data
     */
    public function saveAppNotification($data)
    {
        $notificationType = $this->notificationTypeRepository->findBy(['name' => $data->notificationType])->first();
        $notificationData = (array)$data->dynamicValues;
        $notificationData['type_id'] = $notificationType->id;
        $notificationData['from_user_id'] = Auth::user()->id;

        $users = $this->getRecipients($data);

        foreach ($users as $user) {
            $notificationData['to_user_id'] = $user['id'];
            $this->appNotificationService->save($notificationData);
        }
    }

    public function sendEmailNotification($data)
    {
        $user = $this->userService->findOne($data['user_id']);

        $this->sendEmail($user->email, new WorkflowEmailNotification($data['title'], $data['message'], $data['url']));
    }

    /**
     * @param $data
     * @return array
     */
    private function getRecipients($data): array
    {
        if (!empty($data->dynamicValues['to_users_designation'])) {
            $users = $this->userService->getUserForNotificationSend($data->dynamicValues['to_users_designation']);
        } else {
            $users = [];
        }

        if (isset($data->dynamicValues['to_employee_id']) && count($data->dynamicValues['to_employee_id']) > 0) {
            $employeesUsers = $this->userService->getUserByEmployeeIds($data->dynamicValues['to_employee_id'])->toArray();
            $users = array_merge($users, $employeesUsers);
        }

        if (isset($data->dynamicValues['proposal_id'])) {
            $proposal = $this->researchProposalSubmissionService->findOne($data->dynamicValues['proposal_id']);
            array_push($users, $proposal->submittedBy->toArray());
        }

        return $users;
    }

    /**
     * @param $data
     * @return string
     */
    private function getNotificationMessage($data): string
    {
        return $data->dynamicValues['message'];
    }
}
