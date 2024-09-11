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

    public  $id;

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

        $pdf1 = PDF::loadView('pdf.general', $bitacora_controller -> getDataGeneral($this->id));
        $pdf2 = PDF::loadView('pdf.partepesca', $bitacora_controller -> getDataPartePesca($this->id));

        // Obtener el contenido del PDF
        $pdfContent1 = $pdf1->output();
        $pdfContent2 = $pdf2->output();

        return (new MailMessage)
                   ->subject('Información de bitacora')
                   ->greeting('Hola!')
                   ->line('Adjunto encontrarás el pdf parte de pesca y general.')
                   ->attachData($pdfContent1, 'General.pdf', [
                       'mime' => 'application/pdf',
                   ])
                   ->attachData($pdfContent2, 'PartePesca.pdf', [
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
