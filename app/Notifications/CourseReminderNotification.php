<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class CourseReminderNotification extends Notification
{
    use Queueable;
    protected $course;
    /**
     * Create a new notification instance.
     */
    public function __construct(Course $course)
    {
        $this->course = $course;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via(object $notifiable): array
    {
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     */
    public function toMail(object $notifiable): MailMessage
    {
        return (new MailMessage)
            ->subject('Rappel : votre cours Wedance est demain')
            ->greeting('Bonjour ' . $notifiable->name . ' !')
            ->line("Ceci est un rappel : vous êtes inscrit(e) au cours : " . $this->course->title)
            ->line("Date : demain (" . $this->course->day_time . ")")
            ->line('Nous avons hâte de vous voir !')
            ->salutation('L’équipe Wedance');
    }

    /**
     * Get the array representation of the notification.
     *
     * @return array<string, mixed>
     */
    public function toArray(object $notifiable): array
    {
        return [
            //
        ];
    }
}
