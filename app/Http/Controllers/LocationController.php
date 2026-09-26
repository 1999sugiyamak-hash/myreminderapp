<?php

namespace App\Http\Controllers;

use App\Models\Reminders;
use App\Services\Notifications;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class LocationController extends Controller
{
    // Check distances between users and destinations
    public function check(Request $request)
    {
        try {
            $user = $request->validate([
                'latitude' => ['required', 'numeric'],
                'longitude' => ['required', 'numeric'],
            ]);

            $reminders = Reminders::with('createdUser')->where('latitude', '!=', null)->get();

            if ($reminders) {
                foreach ($reminders as $reminder) {
                    $user_x = deg2rad($user['latitude']);
                    $user_y = deg2rad($user['longitude']);
                    $reminder_x = deg2rad($reminder['latitude']);
                    $reminder_y = deg2rad($reminder['longitude']);

                    // Calculate distance
                    $EARTH_RAD = 6378.137;
                    $distance = $EARTH_RAD * acos(sin($user_y) * sin($reminder_y) + cos($user_y) * cos($reminder_y) * cos($reminder_x - $user_x));

                    // Send notification if users exist less than 50m from destinations
                    if ($distance <= 50) {
                        $notifications_serivce = new Notifications();
                        return $notifications_serivce->send_notifications($reminder->title, $reminder->createdUser);
                    }
                }
            }

            return response()->json([
                'success' => true,
            ]);
        } catch (Exception $e) {
            $message = $e->getMessage();
            Log::error($message);
        }
    }

    // private function calculate_distance(Float $user_x, Float $user_y, Float $reminder_x, Float $reminder_y)
    // {
    //     $EARTH_RAD = 6378.137;

    //     return $EARTH_RAD * acos(sin($user_y) * sin($reminder_y) + cos($user_y) * cos($reminder_y) * cos($reminder_x - $user_x));
    // }

    // private function deg2rad(Float $deg)
    // {
    //     return $deg * M_PI / 180.0;
    // }
}
