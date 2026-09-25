<?php

namespace App\Services;

use App\Models\Reminders;
use App\Models\Users;
use Illuminate\Support\Facades\Log;
use Minishlink\WebPush\Subscription;
use Minishlink\WebPush\WebPush;

class Notifications
{

    public function send_notifications(string $title, Users $user)
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

        $payload = json_encode([
            'title' => $title,
            'body' => $title,
        ]);

        $report = $webPush -> sendOneNotification(
            $subscription,
            $payload
        );

        if(!$report->isSuccess()){
            Log::error($report->getReason());
        }

    }
}
