<?php


namespace App\Traits;

use App\Entities\Notification\Notification;
use App\Entities\Notification\NotificationType;
use Illuminate\Support\Facades\Auth;

trait NotificationTrait
{
    private function sendNotification($type, $referenceId, $recipient, $message, $url): void
    {
        $notificationType = NotificationType::where('name', $type)->firstOrFail();

        $notification = Notification::create([
            'type_id' => $notificationType->id,
            'ref_table_id' => $referenceId,
            'from_user_id' => Auth::id(),
            'to_user_id' => $recipient,
            'message' => $message,
            'item_url' => $url
        ]);
    }

}
