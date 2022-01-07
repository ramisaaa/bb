<?php

namespace App\Notifications;

use App\Models\Task;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class TaskNotification extends Notification
{
    use Queueable;


    /**
     * @var Task
     */
    private $task;

    /**
     * @param Task $task
     */
    public function __construct(Task $task)
    {
        $task->task=$task;
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
        $user=$this->task->user->name;
        $title=$this->task->title;
        return (new MailMessage)
                    ->subject("یادآوری مصاحبه")
                    ->greeting("$user عزیز")
                    ->line(" مصاحبه شما با عنوان $title کمتر از نیم ساعت دیگر شروع میشود!   ")
                    ->line('موفق باشید :)');
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
