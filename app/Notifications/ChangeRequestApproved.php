<?php
namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

class ChangeRequestApproved extends Notification implements ShouldQueue
{
    use Queueable;

    public function via(object $notifiable): array
    {
        return ['mail', 'database'];
    }

    public function toMail(object $notifiable): MailMessage
    {
        return (new MailMessage)
                    ->subject('Ditt ändringsförslag har godkänts')
                    ->line('Ditt föreslagna ändring har granskats och godkänts.');
    }

    public function toArray(object $notifiable): array
    {
        return [
            'message' => 'Ditt ändringsförslag har godkänts.'
        ];
    }
}
