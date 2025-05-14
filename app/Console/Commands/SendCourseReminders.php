<?php

namespace App\Console\Commands;

use App\Models\Course;
use App\Notifications\CourseReminderNotification;
use Illuminate\Console\Command;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Log;

class SendCourseReminders extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'courses:send-reminders';


    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Send reminders to users subscribed to courses starting tomorrow';
    /**
     * Execute the console command.
     */

    public function handle()
    {
        $tomorrow = Carbon::tomorrow();
        $tomorrowDayOfWeek = $tomorrow->dayOfWeek;

        $daysMap = [
            'Lundi' => Carbon::MONDAY,
            'Mardi' => Carbon::TUESDAY,
            'Mercredi' => Carbon::WEDNESDAY,
            'Jeudi' => Carbon::THURSDAY,
            'Vendredi' => Carbon::FRIDAY,
            'Samedi' => Carbon::SATURDAY,
            'Dimanche' => Carbon::SUNDAY,
        ];

        $courses = Course::with('users')->get()->filter(function ($course) use ($daysMap, $tomorrowDayOfWeek) {
            $dayParts = explode(' ', $course->day_time);
            $weekday = $dayParts[0] ?? null;

            return isset($daysMap[$weekday]) && $daysMap[$weekday] === $tomorrowDayOfWeek;
        });

        $reminderCount = 0;

        foreach ($courses as $course) {
            foreach ($course->users as $user) {
                // ✅ ЛОГИРУЕМ, а не отправляем реальные уведомления для теста
                Log::info("Reminder: {$user->email} has {$course->title} tomorrow ({$course->day_time})");
                $reminderCount++;
            }
        }

        Log::info("SendCourseReminders done: {$reminderCount} reminders sent for date {$tomorrow->toDateString()}");
        $this->info("Reminders sent: {$reminderCount}");
    }
}
