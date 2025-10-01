<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class StockLowMail extends Mailable
{
    use Queueable, SerializesModels;

    public $item;
    public $cantidad;

    public function __construct($item, $cantidad)
    {
        $this->item = $item;
        $this->cantidad = $cantidad;
    }

    public function build()
    {
        return $this->subject("⚠️ Stock bajo: {$this->item}")
                    ->view('emails.stock_low')
                    ->with([
                        'item' => $this->item,
                        'cantidad' => $this->cantidad,
                    ]);
    }
}
