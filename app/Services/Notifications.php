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
        // $user = Reminders::with('users')->where('id', $id)->get();
        Log::info(config('services.web_push.public_key'));

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

        // TODO: Implement body to reminder description
        $payload = json_encode([
            'title' => $reminders->title,
            'body' => $reminders->title,
        ]);

        $report = $webPush -> sendOneNotification(
            $subscription,
            $payload
        );

        if($report->isSuccess()){
            Reminders::where('id', $reminders->id)->update(['reminded' => true]);
        }else{
            Log::error($report->getReason());
        }

    }
}
