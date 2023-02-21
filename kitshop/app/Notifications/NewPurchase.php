<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Notifications\Messages\SlackMessage;

class NewPurchase extends Notification
{
    use Queueable;
    private $data;
    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($data)
    {
        $this->data = $data;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['slack'];
    }

    public function toSlack($notifiable)
    {
        // Storage::prepend('/storage/newpurchasefile.txt', $notifiable);
        $data=$this->data;
    // return (new SlackMessage)->content($this->data->email);

    return (new SlackMessage)->content($data->email . " made a purchase")
        ->attachment(function ($attachment) use ($data) {
            $attachment->title('Click Me', $data->product_permalink)
                       ->fields([
                            'Product' => $data->product_name,
                            'Price' => $data->price,
                            'Quantity' => $data->quantity
                        ]);
        });
    }
    
}
