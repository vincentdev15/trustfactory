<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class DailyReportNotification extends Notification implements ShouldQueue
{
    use Queueable;

    private $date;

    private $articles;

    /**
     * Create a new notification instance.
     */
    public function __construct($date, $articles)
    {
        $this->date = $date;
        $this->articles = $articles;
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
        $mail = new MailMessage;

        $mail
            ->subject('Daily Sales Report : '.$this->date->format('Y-m-d'))
            ->markdown('emails.daily-report', [
                'date' => $this->date,
                'articles' => $this->articles,
            ]);

        return $mail;
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
