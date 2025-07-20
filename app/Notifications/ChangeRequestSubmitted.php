<?php
namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

class ChangeRequestSubmitted extends Notification implements ShouldQueue
{
    use Queueable;

    public function via(object $notifiable): array
    {
        return ['mail', 'database'];
    }

    public function toMail(object $notifiable): MailMessage
    {
        return (new MailMessage)
                    ->subject('Nytt ändringsförslag')
                    ->line('Ett nytt ändringsförslag har skickats in.')
                    ->action('Visa förslag', url('/admin/forfrågningar'));
    }

    public function toArray(object $notifiable): array
    {
        return [
            'message' => 'Nytt ändringsförslag har inkommit.'
        ];
    }
}
