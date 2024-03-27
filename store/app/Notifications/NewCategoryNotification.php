<?php

namespace App\Notifications;

use App\Models\Category;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use NotificationChannels\Fcm\FcmChannel;
use NotificationChannels\Fcm\FcmMessage;
use NotificationChannels\Fcm\Resources\Notification as FcmNotification;
class NewCategoryNotification extends Notification
{
    use Queueable;
    protected $category;

    /**
     * Create a new notification instance.
     */
    public function __construct(Category $category)
    {
        $this->category=$category;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via(object $notifiable): array
    {
        return [FcmChannel::class];
    }

    /**
     * Get the mail representation of the notification.
     */
    public function toMail(object $notifiable): MailMessage
    {
        return (new MailMessage)
                    ->line('The introduction to the notification.')
                    ->action('Notification Action', url('/'))
                    ->line('Thank you for using our application!');
    }

    /**
     * Get the array representation of the notification.
     *
     * @return array<string, mixed>
     */
    public function toFcm($notifiable): FcmMessage
    {
        return (new FcmMessage(notification: new FcmNotification(
            title: 'New Category',
            body: 'New Category added.',
            image: 'http://example.com/url-to-image-here.png'
        )))
            ->data(['category_id' => $this->category->id??"", 'user' => $this->category->user->name??""])
            ->custom([
                'android' => [
                    'notification' => [
                        'color' => '#0A0A0A',
                    ],
                    'fcm_options' => [
                        'analytics_label' => 'analytics',
                    ],
                ],
                'apns' => [
                    'fcm_options' => [
                        'analytics_label' => 'analytics',
                    ],
                ],
            ]);
    }
    public function toArray(object $notifiable): array
    {
        return [
            //
        ];
    }
}
