<?php
namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use App\Mail\StockLowMail;
use Illuminate\Support\Facades\Mail;

class StockLowNotification extends Notification
{
    use Queueable;

    public $item;
    public $cantidad;

    public function __construct($item, $cantidad)
    {
        $this->item = $item;
        $this->cantidad = $cantidad;
    }

    public function via($notifiable)
    {
        return ['mail', 'database']; //Email + sistema
    }

    public function toMail($notifiable)
    {
        return (new StockLowMail($this->item, $this->cantidad))
            ->to('alertas.lab.pb@gmail.com');
    }

    public function toDatabase($notifiable)
    {
        return [
            'item' => $this->item,
            'cantidad' => $this->cantidad,
            'mensaje' => "Stock bajo en {$this->item}: {$this->cantidad} unidades."
        ];
    }
}