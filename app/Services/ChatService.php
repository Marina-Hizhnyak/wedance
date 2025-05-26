<?php

namespace App\Services;

use App\Models\BlogPost;
use App\Models\Course;
use App\Models\Event;
use App\Models\TeamMember;
use Illuminate\Support\Facades\Http;

class ChatService
{
    private $baseUrl;
    private $apiKey;

    public function __construct()
    {
        $this->baseUrl = config('services.openrouter.base_url', 'https://openrouter.ai/api/v1');
        $this->apiKey = config('services.openrouter.api_key');
    }

    private function getFreeModels(): array
    {
        $response = Http::withHeaders([
            'Authorization' => 'Bearer ' . $this->apiKey,
        ])->get($this->baseUrl . '/models');

        return collect($response->json('data') ?? [])
            ->filter(fn($model) => str_ends_with($model['id'], ':free'))
            ->pluck('id')
            ->values()
            ->all();
    }

    private function getWebsiteContext(): string
    {
        $courses = Course::with(['instructor', 'category', 'level'])->get();

        $courseLines = $courses->map(function ($course) {
            $teacher = $course->instructor?->name ?? 'Inconnu';
            $category = $course->category?->name ?? 'Catégorie inconnue';
            $level = $course->level?->name ?? 'Niveau inconnu';

            $url = route('courses.byCategoryAndLevel', [
                'categorySlug' => $course->category->slug,
                'levelSlug' => $course->level->slug,
            ]);

            return "Titre : {$course->title}\n"
                . "Prix : {$course->price} €\n"
                . "Durée : {$course->duration}\n"
                . "Jour/Heure : {$course->day_time}\n"
                . "Professeur : $teacher\n"
                . "Catégorie : $category\n"
                . "Niveau : $level\n"
                . "Lien : $url\n"
                . "---";
        })->implode("\n");

        $teachersWithCourses = $courses->groupBy(fn($course) => $course->instructor?->name ?? 'Inconnu')
            ->map(function ($groupedCourses, $teacher) {
                $lines = $groupedCourses->map(function ($course) {
                    return "{$course->title} ({$course->day_time})";
                })->implode(', ');
                return "$teacher : $lines";
            })
            ->implode("\n- ");

        $events = Event::with('organizer')->orderBy('date')->limit(5)->get()
            ->map(function ($event) {
                $title = $event->title;
                $description = $event->description ?? 'Pas de description';
                $dateTime = \Carbon\Carbon::parse($event->date)->format('d/m/Y à H:i');
                $location = $event->location ?? 'Lieu inconnu';
                $organizer = $event->organizer?->name ?? 'Wedance';
                $url = route('events');

                return "Titre : $title\nDate : $dateTime\nLieu : $location\nOrganisateur : $organizer\nLien : $url\nDescription : $description\n---";
            })
            ->implode("\n");

        $teachers = TeamMember::with('user')->get()
            ->map(function ($member) {
                $name = $member->user?->name ?? 'Inconnu';
                $role = $member->role ?? 'Rôle inconnu';
                $description = $member->description ?? 'Aucune description';
                $quote = $member->quote ? "Citation : \"{$member->quote}\"" : '';

                return "Nom : $name\nRôle : $role\nDescription : $description\n$quote\n---";
            })
            ->implode("\n");

        $blogs = BlogPost::orderByDesc('created_at')->limit(3)->get()
            ->map(function ($post) {
                $title = $post->title;
                $date = $post->created_at?->format('d/m/Y');
                $full = strip_tags($post->content);
                $excerpt = strlen($full) > 300 ? substr($full, 0, 300) . '...' : $full;
                $url = route('blog.show', $post->slug);

                return "Titre : $title\nDate : $date\nRésumé : $excerpt\nLien : $url\nContenu complet : $full\n---";
            })
            ->implode("\n");

        $calendarService = new \App\Services\CalendarEventService();
        $calendarEvents = $calendarService->getCalendarEvents(now()->startOfMonth(), now()->addMonths(3)->endOfMonth());

        $calendarText = collect($calendarEvents)->map(function ($item) {
            return "{$item['date']} – {$item['title']}";
        })->implode("\n");

        return "Voici les informations actuelles de l'école Wedance :\n\n"
            . "📚 Liste des cours :\n$courseLines\n\n"
            . "👨‍🏫 Professeurs et leurs cours :\n- $teachersWithCourses\n\n"
            . "🧑‍🏫 Informations détaillées sur les professeurs :\n$teachers\n\n"
            . "📅 Événements à venir :\n$events\n\n"
            . "📆 Prochains événements du calendrier :\n$calendarText\n\n"
            . "📝 Derniers articles du blog :\n$blogs\n\n"
            . "Merci d'utiliser ces informations pour répondre de façon précise et utile à l'utilisateur.";
    }


    public function sendMessage(string $message, float $temperature = 0.7): string
    {
        $models = $this->getFreeModels();
        $context = $this->getWebsiteContext();

        foreach ($models as $model) {
            try {
                $response = Http::withHeaders([
                    'Authorization' => 'Bearer ' . $this->apiKey,
                ])->post($this->baseUrl . '/chat/completions', [
                    'model' => $model,
                    'messages' => [
                        [
                            'role' => 'system',
                            'content' => "Tu es l'assistant officiel de l/'école Wedance. Tu comprends automatiquement la langue utilisée par l'utilisateur (français, anglais ou ukrainien) et tu réponds dans la même langue. Voici des informations importantes sur le site :\n\n$context\n\n"
                                . "Tu dois être professionnel, amical, et toujours utile. Voici quelques termes fréquents à connaître, même en anglais :
                            - price = prix
                            - schedule = horaire
                            - course = cours
                            - teacher = professeur
                            - event = événement

                            Réponds maintenant à la question de l'utilisateur.",
                        ],
                        ['role' => 'user', 'content' => $message],
                    ],
                    'temperature' => $temperature,
                ]);

                if ($response->successful()) {
                    $content = $response->json('choices.0.message.content');
                    if ($content) return $content;
                }
            } catch (\Exception $e) {

                continue;
            }
        }

        return "Désolé, pas de réponse disponible pour le moment.";
    }
}
