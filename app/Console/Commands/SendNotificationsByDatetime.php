<?php

namespace App\Console\Commands;

use App\Models\Reminders;
use Illuminate\Console\Attributes\Description;
use Illuminate\Console\Attributes\Signature;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;
use App\Services\Notifications;

#[Signature('app:send-notifications-by-datetime')]
#[Description('Command description')]
class SendNotificationsByDatetime extends Command
{
    /**
     * Execute the console command.
     */
    public function handle()
    {
        $datetime_reminders = Reminders::with('receivedUser')
            ->where([['remind_at', '=', now("Asia/Tokyo")->startOfMinute()], ['completed', '=', false], ['reminded', '=', false]])
            ->get();

        // Search dailt reminders to match current time(H:i)
        $current_time = now("Asia/Tokyo")->format('H:i');
        $daily_reminders = Reminders::with('receivedUser')
        ->where([['repeated', '=', true], ['completed', '=', false], ['reminded', '=', false]])
        ->whereRaw("DATE_FORMAT(remind_at, '%H:%i') =? ", $current_time)
        ->get();

        $reminders = $datetime_reminders->merge($daily_reminders);

        foreach ($reminders as $reminder) {
            $this->info(
                "Reminder: {$reminder->title} / {$reminder->remind_at}"
            );
            Log::Info("Success");
            $notifications_serivce = new Notifications();
            return $notifications_serivce->send_notifications($reminder, $reminder->receivedUser);
        }

        return Command::SUCCESS;
    }
}
