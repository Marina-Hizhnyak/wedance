<?php

namespace App\Services;

use App\Models\Course;
use App\Models\Event;
use Carbon\Carbon;

class CalendarEventService
{
    public function getCalendarEvents(Carbon $start, Carbon $end): array
    {
        $courseEvents = Course::with(['category', 'level'])->get()->flatMap(function ($course) use ($start, $end) {
            $dayParts = explode(' ', $course->day_time);
            $weekday = $dayParts[0] ?? null;

            if (!$weekday) return [];

            $dates = $this->getAllDatesForWeekdayInRange($weekday, $start, $end);

            return collect($dates)->map(function ($date) use ($course) {
                return [
                    'title' => 'Cours: ' . $course->title,
                    'date' => $date,
                    'type' => 'cours',
                ];
            });
        });

        $eventEvents = Event::whereBetween('date', [$start, $end])->get()->map(function ($event) {
            return [
                'title' => 'Événement: ' . $event->title,
                'date' => Carbon::parse($event->date)->toDateString(),
                'type' => 'événement',
            ];
        });

        return $courseEvents->merge($eventEvents)->sortBy('date')->values()->all();
    }

    private function getAllDatesForWeekdayInRange(string $weekdayName, Carbon $start, Carbon $end): array
    {
        $daysMap = [
            'Lundi' => Carbon::MONDAY,
            'Mardi' => Carbon::TUESDAY,
            'Mercredi' => Carbon::WEDNESDAY,
            'Jeudi' => Carbon::THURSDAY,
            'Vendredi' => Carbon::FRIDAY,
            'Samedi' => Carbon::SATURDAY,
            'Dimanche' => Carbon::SUNDAY,
        ];

        if (!isset($daysMap[$weekdayName])) return [];

        $dates = [];
        $current = $start->copy()->next($daysMap[$weekdayName]);

        if ($start->dayOfWeek === $daysMap[$weekdayName]) {
            $current = $start->copy();
        }

        while ($current->lte($end)) {
            $dates[] = $current->toDateString();
            $current->addWeek();
        }

        return $dates;
    }
}
