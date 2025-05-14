<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\Event;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Inertia\Inertia;

class CalendarController extends Controller
{
    public function index()
    {
        $start = now()->startOfMonth();
        $end = now()->addMonths(3)->endOfMonth();

        $courseEvents = Course::with(['category', 'level'])->get()->flatMap(function ($course) use ($start, $end) {
            $dayParts = explode(' ', $course->day_time);
            $weekday = $dayParts[0] ?? null;

            if (!$weekday) return [];

            $dates = $this->getAllDatesForWeekdayInRange($weekday, $start, $end);

            return collect($dates)->map(function ($date) use ($course) {
                return [
                    'title' => 'Cours: ' . $course->title,
                    'start' => $date,
                    'url' => route('courses.byCategoryAndLevel', [
                        'categorySlug' => $course->category->slug,
                        'levelSlug' => $course->level->slug,
                    ]),
                    'backgroundColor' => $this->getColorForCourse($course),
                    'borderColor' => $this->getColorForCourse($course),
                    'textColor' => '#FFFFFF',
                ];
            });
        });

        $eventEvents = Event::whereBetween('date', [$start, $end])->get()->map(function ($event) {
            return [
                'title' => 'Événement: ' . $event->title,
                'start' => Carbon::parse($event->date)->toDateString(),
                'url' => route('events'),
            ];
        });

        return Inertia::render('CalendarPage', [
            'events' => $courseEvents->merge($eventEvents),
        ]);
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

    private function getColorForCourse($course)
    {
        if (!$course->category) return '#1ABC9C';

        return match ($course->category->name) {
            'Salsa' => '#E63946',
            'Bachata' => '#FFB400',
            'Kizomba' => '#FFB400',
            'Lady Styling' => '#8E44AD',
            'Zouk' => '#2ECC71',
            default => '#1ABC9C',
        };
    }
}
