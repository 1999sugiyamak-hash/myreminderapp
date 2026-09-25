<?php

namespace App\Console\Commands;

use App\Http\Controllers\ReminderController;
use App\Models\Reminders;
use Illuminate\Console\Attributes\Description;
use Illuminate\Console\Attributes\Signature;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;
use App\Services\Notifications;

#[Signature('app:send-reminder-notifications')]
#[Description('Command description')]
class SendReminderNotifications extends Command
{
    /**
     * Execute the console command.
     */
    public function handle()
    {
        $reminders = Reminders::with('receivedUser')
        ->where('remind_at', '=', now("Asia/Tokyo")->startOfMinute())
        ->where('completed', false)
        ->get();

        foreach($reminders as $reminder){
            $this->info(
                "Reminder: {$reminder->title} / {$reminder->remind_at}"
            );
            Log::Info("Success");
            $notifications_serivce = new Notifications();
            return $notifications_serivce->send_notifications($reminder->title, $reminder->receivedUser);
        }

        return Command::SUCCESS;
    }
}
