<?php

namespace App\Mail;

use App\Models\Reserva;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class PrestamoConfirmadoMail extends Mailable
{
    use Queueable, SerializesModels;

    public $reserva;

    /**
     * Create a new message instance.
     */
    public function __construct(Reserva $reserva)
    {
        $this->reserva = $reserva;
    }

    public function build()
    {
        return $this->subject('Préstamo confirmado')
                    ->markdown('emails.prestamo.confirmado')
                    ->with(['reserva' => $this->reserva]);
    }
}