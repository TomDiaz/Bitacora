<?php

namespace App\Notifications;

use App\Http\Controllers\BitacorasController;
use PDF;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class EnvioPDFCapitan extends Notification
{
    use Queueable;

    protected  $id;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($id)
    {
        $this -> id = $id;
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

        $bitacora_controller = new BitacorasController();

        $pdf = PDF::loadView('pdf.general', $bitacora_controller -> getDataGeneral($this->id));

        // Obtener el contenido del PDF
        $pdfContent = $pdf->output();

        return (new MailMessage)
                   ->subject('Parte de Pesca')
                   ->greeting('Hola!')
                   ->line('Adjunto encontrarás el parte de pesca generado.')
                   ->attachData($pdfContent, 'PartePesca.pdf', [
                       'mime' => 'application/pdf',
                   ])
                   ->line('Gracias por utilizar nuestro sistema!');
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
