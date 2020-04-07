<?php
/**
 * Created by PhpStorm.
 * User: siaminflack
 * Date: 6/11/19
 * Time: 1:04 PM
 */

namespace App\Traits;

use App\Constants\NotificationType as NotificationTypeConstant;
use App\Entities\Notification\Notification;
use App\Entities\Notification\NotificationType;
use App\Entities\StateDetail;
use App\Entities\StateRecipient;
use App\Entities\User;
use App\Mail\WorkflowEmailNotification;
use Iben\Statable\Statable;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;

trait Workflowable
{
    use Statable;

    public function applyTransition($transition, $beforeRecipients = [], $details = [])
    {
        $this->apply($transition);

        $this->stateMachine()->getObject()->save();

        $recipients = $this->saveRecipients($beforeRecipients);

        $this->saveDetails($details);

        $this->sendNotification($recipients);
    }

    public function getStateOwnerTransition()
    {
        $possibleTransitions = array_filter(
            $this->stateMachine()->getPossibleTransitions(),
            [$this, 'filterPossibleTransitions']
        );

        return array_values(array_unique($possibleTransitions));
    }

    // TODO: change this to call specific method from arguments | User::all()->filter(function($user) {})
    public function getNextStatePossibleRecipients()
    {
        $users = User::all()
            ->filter(function ($user) {
                return (in_array($user->id, $this->nextRecipientWithKeys()) && (auth()->user()->id != $user->id));
            })->values()
            ->pluck('name', 'id');

        return $users;
    }

    public function isRecipient()
    {
        return is_null($this->stateOwner()) ? false : true;
    }

    public function getStateUrl()
    {
        $object = $this->stateMachine()->getObject();

        return route($this->stateMachine()->metadata(
            'state',
            $this->stateMachine()->getState(),
            'url'
        ), $object->id);
    }

    public function filterPossibleTransitions($transition)
    {
        $possibleTransition = auth()->user()->hasRole($this->stateMachine()->metadata(
            'transition',
            $transition,
            'action.role'
        ));

        $data = $this->canCurrentUserReceive();

        if (!is_null($possibleTransition)) {
            $data[] = $possibleTransition;
        }

        $data = array_unique($data);

        return in_array($transition, $data);
    }

    public function canCurrentUserReceive()
    {
        $data = [];

        if ($this->stateMachine()->getObject()->receiver_id == auth()->user()->id
            || $this->stateMachine()->getObject()->requester_id == auth()->user()->id) {

            $data[] = 'receive';
        }

        return $data;
    }

    private function stateOwner()
    {
        $lastHistory = $this->stateMachine()->getObject()->stateHistory->last();

        if (is_null($lastHistory)) {
            return null;
        }

        $stateRecipient = DB::table('state_recipients')
            ->where('state_history_id', $lastHistory->id)
            ->where('user_id', auth()->user()->id)
            ->first();

        if($this->isStoreKeeper() && $this->stateMachine()->getObject()->status == 'approved') {
            return auth()->user();
        }

        return empty($stateRecipient) ? null : $stateRecipient;
    }

    private function getAfterRecipients()
    {
        $recipients = $this->getStateRecipientsByRoles();

        $recipients = $recipients->merge($this->getStateRecipientsByKeys());

        return $recipients->unique();
    }

    /**
     * @param $transition
     * @return array
     * @throws \Illuminate\Container\EntryNotFoundException
     */
    private function getStateRecipientsByRoles()
    {
        $object = $this->stateMachine()->getObject();

        $roles = $this->stateMachine()->metadata('state', $this->stateMachine()->getState(), 'recipients.type.after.roles');

        return ($this->getUsers($object->requester_id, $roles));
    }

    private function getStateRecipientsByKeys()
    {
        $object = $this->stateMachine()->getObject();

        $keys = $this->stateMachine()->metadata('state', $this->stateMachine()->getState(), 'recipients.type.after.keys');

        $recipients = collect();

        if (!is_null($keys) && is_array($keys)) {
            foreach ($keys as $key) {

                if (!is_null($object->$key)) {
                    $user = User::findOrFail($object->$key);
                    if (!is_null($user)) {
                        $recipients->push($user);
                    }
                }
            }
        }

        return $recipients;
    }

    private function getUsers($requester_id, $roles)
    {
        $requester = User::findOrFail($requester_id);

        $departmentId = get_user_department($requester)->id;

        $users = User::all()
            ->filter(function ($user) use ($departmentId, $roles) {
                if (!empty($user->employee)) {
                    return get_user_department($user)->id == $departmentId && $user->hasAnyRole($roles);
                }
            });

        return !empty($users) ? $users : collect();

    }

    private function nextRecipientWithKeys()
    {
        $possibleTransitions = $this->stateMachine()->getPossibleTransitions();

        $recipientValuesByKey = [];

        foreach ($possibleTransitions as $possibleTransition) {
            $next_state = $this->stateMachine()->metadata(
              'transition',
              $possibleTransition,
              'next_state'
            );

            if (!is_null($next_state)) {

                $values = $this->stateMachine()->metadata(
                    'state',
                    $next_state,
                    'recipients.type.before.entity.values'
                );

                $recipientValuesByKey = array_merge($recipientValuesByKey, is_array($values) ? $values : []);
            }

        }

        return array_unique($recipientValuesByKey);

    }

    private function nextRecipientsRoles()
    {

        $possibleTransitions = $this->stateMachine()->getPossibleTransitions();

        $recipientRoles = [];

        foreach ($possibleTransitions as $possibleTransition) {

            $next_state = $this->stateMachine()->metadata(
                'transition',
                $possibleTransition,
                'next_state'
            );

            if (!is_null($next_state)) {
                $roles = $this->stateMachine()->metadata(
                    'state',
                    $next_state,
                    'recipients.type.before.roles'
                );

                if (!is_null($roles) && is_array($roles)) {
                    $recipientRoles = array_merge($roles, $recipientRoles);
                }
            }

        }

        return array_unique($recipientRoles);

    }

    private function saveRecipients($beforeRecipients)
    {
        $recipients = $this->getAfterRecipients();

        if (!empty($beforeRecipients)) {
            $recipients = $recipients->merge($beforeRecipients);
        }

        $lastStateHistory = $this->stateMachine()->getObject()->stateHistory->last();

        if (!empty($recipients)) {
            foreach ($recipients as $recipient) {
                StateRecipient::create([
                    'state_history_id' => $lastStateHistory->id,
                    'user_id' => $recipient->id,
                ]);
            }
        }

        return $recipients;
    }

    private function saveDetails($details)
    {
        $lastStateHistory = $this->stateMachine()->getObject()->stateHistory->last();

        if (!empty($details)) {
            StateDetail::create([
                'state_history_id' => $lastStateHistory->id,
                'message' => !empty($details['message']) ? $details['message'] : null,
                'remark' => !empty($details['remark']) ? $details['remark'] : "",
            ]);
        }
    }

    /**
     * @param $recipients
     * @throws \Illuminate\Container\EntryNotFoundException
     */
    private function sendNotification($recipients): void
    {
        $notificationType = NotificationType::where('name', NotificationTypeConstant::IMS_WORKFLOW)->firstOrFail();

        if (!count($recipients)) return;

        foreach ($recipients as $recipient) {
            $notification = Notification::create([
                'type_id' => $notificationType->id,
                'ref_table_id' => $this->stateMachine()->getObject()->id,
                'from_user_id' => Auth::id(),
                'to_user_id' => $recipient->id,
                'message' => 'Inventory Request is ' . $this->stateMachine()->getState(),
                'item_url' => $this->getStateUrl()
            ]);

            Mail::to($recipient)->send(
                new WorkflowEmailNotification(
                    'IMS Workflow',
                    $notification->message,
                    $this->getStateUrl()
                )
            );
        }
    }

    public function isStoreKeeper()
    {
        $storeKeeper = User::where('username', 'STO')->first();

        if(is_null($storeKeeper)) {
            return false;
        }

        return (auth()->user()->id === $storeKeeper->id);
    }
}