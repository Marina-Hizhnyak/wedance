<?php

namespace App\Notifications;

use App\Models\Course;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class NewCourseNotification extends Notification
{
    use Queueable;

    public Course $course;

    public function __construct(Course $course)
    {
        $this->course = $course;
    }

    public function via($notifiable)
    {
        return ['mail'];
    }

    public function toMail($notifiable)
    {
        return (new MailMessage)
            ->subject('🆕 Nouveau cours disponible !')
            ->greeting('Bonjour ' . $notifiable->name . ' !')
            ->line("Un nouveau cours a été ajouté : **{$this->course->title}**")
            ->line("Niveau : {$this->course->level->name}")
            ->line("Catégorie : {$this->course->category->name}")
            ->action('Voir le cours', url('/cours/' . $this->course->category->slug . '/' . $this->course->level->slug))
            ->line('À bientôt sur Wedance !');
    }
}
