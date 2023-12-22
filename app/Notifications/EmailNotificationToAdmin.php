<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class EmailNotificationToAdmin extends Notification
{
    use Queueable;
    public $email;
    public $code;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($code,$email)
    {
        $this->code = $code;
        $this->email = $email;
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
                    ->subject('Creation de compte administrateur')
                    ->line('Bonjour')
                    ->line('Votre compte est cree avec succes')
                    ->line('Cliquer sur le bouton ci dessous pour valider votre compte')
                    ->line('saisissez le code '.$this->code.'et renseigner le dans le formulaire')
                    ->action('Cliquez ici', url('/validate-account'.'/'.$this->email))
                    ->line('Merci d\'utiliser nos service!');
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
