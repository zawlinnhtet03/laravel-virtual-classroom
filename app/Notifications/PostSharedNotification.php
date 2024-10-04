<?php

namespace App\Notifications;

use App\Models\Post;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class PostSharedNotification extends Notification implements ShouldQueue
{
    use Queueable;

    private $post;
    private $signedLink;

    /**
     * Create a new notification instance.
     */
    public function __construct(Post $post,string $signedLink)
    {
        //

        $this->post = $post; 
        $this->signedLink = $signedLink; 
    }

    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via(object $notifiable): array
    {

        // mail,database,broadcast, vonage and slack

        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     */
    public function toMail(object $notifiable): MailMessage
    {
        return (new MailMessage)
                    ->subject('Post Shared' . $this->post->title)

                    ->action('View the post here', $this->signedLink )
                    ->line('Thank you for using our application!');
    }

    /**
     * Get the array representation of the notification.
     *
     * @return array<string, mixed>
     */
    public function toArray(object $notifiable): array
    {
        return [
            //
        ];
    }
}
