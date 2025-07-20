use App\Notifications\ResetPasswordNotification;

public function sendPasswordResetNotification($token)
{
    $this->notify(new ResetPasswordNotification($token));
}
