<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use Kutia\Larafirebase\Messages\FirebaseMessage;

class FirebaseNotification extends Notification
{
    /**
     * Get the notification's delivery channels.
     */
    public function via($notifiable)
    {
        return ['firebase'];
    }

    /**
     * Get the firebase representation of the notification.
     */
    public function toFirebase($notifiable)
    {
        $deviceTokens = [
            'dbQKqgDBMgyp2beqchScUm:APA91bEWSjfiTkLVbjBZVaeYeFAWtZOr60BJDYUlyyOx_INdNKDP7hUvPc3Cz8s89BwO1FS2QdkCzukKGAcD8eyDvOZb0Jet3788jooTjva6gJRVuqlKTYwKmf7PGA3HDkZNwNqIecnu',
            'dRDhnY9pwlekKoq7_Ni9RR:APA91bEuJh70grZQ5-3sDu81xdbgsJMAt4k479tH0zY7Eb63Ub9rfYFZNY0EbzWmtnpND33xBwmjUXPcfXz6ePWNnJTMTCBEBBU-gKs693UEpHpDgtCfBx3cVEaOfQ6IAynLUrHijxqE'
        ];

        return (new FirebaseMessage)
            ->withTitle('Hey, ', $notifiable->first_name)
            ->withBody('Happy Birthday!')
            ->asNotification($deviceTokens); // OR ->asMessage($deviceTokens);
    }
}
