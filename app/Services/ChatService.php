<?php

namespace App\Services;

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
        $courses = \App\Models\Course::pluck('title')->implode(', ');
        $events = \App\Models\Event::orderBy('date')->limit(5)->pluck('title')->implode(', ');
        $teachers = \App\Models\TeamMember::pluck('name')->implode(', ');
        $blogs = \App\Models\BlogPost::orderByDesc('created_at')->limit(3)->pluck('title')->implode(', ');
        // $calendarEvents = \App\Models\CalendarEvent::orderBy('date')->limit(5)->pluck('title')->implode(', ');

        return "Voici les informations actuelles du site :\n\n"
            . "📚 Cours : $courses\n\n"
            . "📅 Événements à venir : $events\n\n"
            . "📝 Derniers articles du blog : $blogs\n\n"
            // . "📆 Prochains événements du calendrier : $calendarEvents\n\n"
            . "👨‍🏫 Professeurs : $teachers\n\n"
            . "Merci d'utiliser ces informations pour répondre à l'utilisateur.";
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
                            'content' => "Tu es l'assistant officiel du site Wedance. Voici des informations importantes :\n\n$context\n\n"
                                . "Sois professionnel, amical et aide toujours l'utilisateur. Réponds maintenant à sa question.",
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
    // public function sendMessage(string $message, float $temperature = 0.7): string
    // {
    //     $models = $this->getFreeModels();

    //     foreach ($models as $model) {
    //         try {
    //             $response = Http::withHeaders([
    //                 'Authorization' => 'Bearer ' . $this->apiKey,
    //             ])->post($this->baseUrl . '/chat/completions', [
    //                 'model' => $model,
    //                 'messages' => [
    //                     ['role' => 'system', 'content' => 'Tu es un assistant pour le site de l\'école Wedance. Sois poli, professionnel et aide les utilisateurs.'],
    //                     ['role' => 'user', 'content' => $message],
    //                 ],
    //                 'temperature' => $temperature,
    //             ]);

    //             if ($response->successful()) {
    //                 $content = $response->json('choices.0.message.content');
    //                 if ($content) return $content;
    //             }
    //         } catch (\Exception $e) {
    //             continue;
    //         }
    //     }

    //     return "Désolé, pas de réponse disponible.";
    // }
}
