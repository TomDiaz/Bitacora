<?php
namespace App\Notifications;

use Illuminate\Notifications\Notification;
use Illuminate\Notifications\Messages\MailMessage;

class ResetPasswordCapitan extends Notification
{
    public $capitan;
    public $token;

    /**
     * Crear una nueva instancia de notificación.
     *
     * @param  mixed  $capitan
     * @return void
     */
    public function __construct($token,$capitan)
    {
        $this->capitan = $capitan;
        $this->token = $token;
    }

    /**
     * Obtener los canales de notificación.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['mail'];
    }

    /**
     * Obtener la representación en correo electrónico de la notificación.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {
        $count = config('auth.passwords.'.config('auth.defaults.passwords').'.expire');
        // Aquí no necesitas pasar el token, ya que Laravel lo gestionará internamente
        return (new MailMessage)
            ->subject('Restablecer Contraseña')
            ->line('Has recibido este correo porque solicitaste un restablecimiento de contraseña para tu cuenta de la app.')
            ->action('Restablecer Contraseña', url(route('password.reset', [
                'token' =>  $this->token, // Laravel lo maneja internamente
                'email' => $this->capitan->email,
                'broker' => 'capitan'
            ], false)))
            ->line('Este enlace para restablecer la contraseña expirará en ' . $count  . ' minutos.');
    }
}
