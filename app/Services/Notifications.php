<?php

namespace App\Services;

use App\Models\Reminders;
use App\Models\Users;
use Illuminate\Support\Facades\Log;
use Minishlink\WebPush\Subscription;
use Minishlink\WebPush\WebPush;

class Notifications
{

    public function send_notifications(Reminders $reminders, Users $user)
    {
        $subscription = Subscription::create([
            'endpoint' => $user->endpoint,
            'keys' => [
                'p256dh' => $user->key,
                'auth' => $user->token,
            ],
        ]);

        $auth = [
            'VAPID' => [
                'subject' => config('services.web_push.project'),
                'publicKey' => config('services.web_push.public_key'),
                'privateKey' => config('services.web_push.private_key'),
            ]
        ];

        $webPush = new WebPush($auth);

        $payload = json_encode([
            'title' => $reminders->title,
            'body' => $reminders->description ? $reminders->description : $reminders->title,
            'icon' => '/images/image_notification.png'
        ]);


        $report = $webPush->sendOneNotification(
            $subscription,
            $payload
        );


        if ($report->isSuccess()) {
            if ($reminders->repeated == false) {
                Reminders::where('id', $reminders->id)->update(['reminded' => true]);
            }
        } else {
            Log::error($report->getReason());
        }
    }
}
