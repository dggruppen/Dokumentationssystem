<?php
namespace App\Notifications;

use Illuminate\Notifications\Notification;
use Illuminate\Notifications\Messages\MailMessage;

class ResetPasswordNotification extends Notification
{
    public function __construct(public string $token) {}

    public function via(object $notifiable): array
    {
        return ['mail'];
    }

    public function toMail(object $notifiable): MailMessage
    {
        return (new MailMessage)
            ->subject('Återställ ditt lösenord')
            ->line('Du har begärt att återställa ditt lösenord.')
            ->action('Återställ lösenord', url('/reset-password/' . $this->token))
            ->line('Om du inte begärde detta behöver du inte göra något.');
    }
}
