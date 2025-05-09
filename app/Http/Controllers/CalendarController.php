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
        $year = now()->year;
        $month = now()->month;

        // $courseEvents = Course::with('category', 'level')->get()->flatMap(function ($course) use ($year, $month) {
        //     $dates = $this->getAllDatesForWeekday($course->day_of_week, $year, $month);

        //     return collect($dates)->map(function ($date) use ($course) {
        //         return [
        //             'title' => 'Cours: ' . $course->title,
        //             'start' => $date,
        //             'url' => route('courses.byCategoryAndLevel', [
        //                 'categorySlug' => $course->category->slug,
        //                 'levelSlug' => $course->level->slug,
        //             ]),
        //         ];
        //     });
        // });
        $courseEvents = Course::with(['category', 'level'])->get()->flatMap(function ($course) use ($year, $month) {
            $dayParts = explode(' ', $course->day_time); // разбиваем "Vendredi 18:00"
            $weekday = $dayParts[0] ?? null;

            if (!$weekday) {
                return []; // если нет дня — пропускаем
            }

            $dates = $this->getAllDatesForWeekday($weekday, $year, $month);

            return collect($dates)->map(function ($date) use ($course) {
                return [
                    'title' => 'Cours: ' . $course->title,
                    'start' => $date,
                    'url' => route('courses.byCategoryAndLevel', [
                        'categorySlug' => $course->category->slug,
                        'levelSlug' => $course->level->slug,
                    ]),
                ];
            });
        });


        $eventEvents = Event::all()->map(function ($event) {
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

    private function getAllDatesForWeekday(string $weekdayName, int $year, int $month): array
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

        if (!isset($daysMap[$weekdayName])) {
            return [];
        }

        $firstDay = Carbon::create($year, $month, 1);
        $lastDay = $firstDay->copy()->endOfMonth();
        $dates = [];

        $current = $firstDay->copy()->next($daysMap[$weekdayName]);
        if ($firstDay->dayOfWeek === $daysMap[$weekdayName]) {
            $current = $firstDay->copy();
        }

        while ($current->lte($lastDay)) {
            $dates[] = $current->toDateString();
            $current->addWeek();
        }

        return $dates;
    }

    // private function getAllDatesForWeekday($weekday, $year, $month)
    // {
    //     $dates = [];

    //     try {
    //         $dayNumber = Carbon::parse($weekday)->dayOfWeek;
    //     } catch (\Exception $e) {
    //         return [];
    //     }

    //     $date = Carbon::createFromDate($year, $month, 1)->startOfMonth();
    //     $end = $date->copy()->endOfMonth();

    //     while ($date->lte($end)) {
    //         if ($date->dayOfWeek === $dayNumber) {
    //             $dates[] = $date->toDateString();
    //         }
    //         $date->addDay();
    //     }

    //     return $dates;
    // }


    // private function getAllDatesForWeekday($weekday, $year, $month)
    // {
    //     $dayOfWeekMap = [
    //         'Lundi' => 1,
    //         'Mardi' => 2,
    //         'Mercredi' => 3,
    //         'Jeudi' => 4,
    //         'Vendredi' => 5,
    //         'Samedi' => 6,
    //         'Dimanche' => 0,
    //     ];

    //     if (!isset($dayOfWeekMap[$weekday])) return [];

    //     $targetWeekday = $dayOfWeekMap[$weekday];

    //     $date = Carbon::createFromDate($year, $month, 1);
    //     $dates = [];

    //     while ($date->month === $month) {
    //         if ($date->dayOfWeek === $targetWeekday) {
    //             $dates[] = $date->toDateString();
    //         }
    //         $date->addDay();
    //     }

    //     return $dates;
    // }
}
