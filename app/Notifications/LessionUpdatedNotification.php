<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

class LessionUpdatedNotification extends Notification
{
    use Queueable;
    protected $lession;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($lession)
    {
        $this->lession = $lession;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['database'];
    }

    /**
     * Get the array representation of the notification.
     *
     * @param  mixed $notifiable
     * @return array
     */
    public function toArray($notifiable)
    {
        //array version of the data
        return $this->lession->toArray();
    }
}
