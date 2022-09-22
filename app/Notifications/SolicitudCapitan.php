<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use App\Models\User;
class SolicitudCapitan extends Notification
{
    use Queueable;
    protected $token;
    protected $armador;
    protected $embarcacion;
    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($token, $id_armador, $embarcacion)
    {
        $this -> token = $token;
        $this -> armador = User::find($id_armador);
        $this -> embarcacion =  $embarcacion;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {
        return (new MailMessage)
                    ->line('El armador '. $this -> armador ->  name . ' '. $this -> armador ->  last_name . ' de la empresa ' . $this -> armador ->  empresa . ' vinculó a tu cuenta de capitán la embarcación ' . $this -> embarcacion .  '. De ahora en adelante, el armador podrá vincular otras de sus embarcaciones a tu cuenta. Para finalizar la operación y visualizarlo en tu cuenta de la App, acepta abajo y luego ingresa a tu cuenta de App.')
                    ->action('Aceptar solicitud', url(env('APP_URL') . 'solicitud/' . $this -> token));
    }

    /**
     * Get the array representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function toArray($notifiable)
    {
        return [
            //
        ];
    }
}
