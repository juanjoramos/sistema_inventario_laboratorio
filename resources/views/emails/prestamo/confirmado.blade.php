@component('mail::message')
# Préstamo confirmado

Hola {{ $reserva->user->name }},

Tu préstamo ha sido **registrado exitosamente** en el sistema.

### 🧾 Detalles del préstamo:
- **Ítem:** {{ $reserva->item->nombre }}
- **Cantidad:** {{ $reserva->cantidad }}
- **Fecha de préstamo:** {{ $reserva->fecha_prestamo->format('d/m/Y H:i') }}
- **Fecha de devolución prevista:** {{ \Carbon\Carbon::parse($reserva->fecha_devolucion_prevista)->format('d/m/Y') }}
- **Motivo:** {{ $reserva->motivo }}

@component('mail::button', ['url' => route('reservas.mis')])
Ver mis reservas
@endcomponent

Gracias por utilizar el sistema de préstamos de {{ config('app.name') }}.

Saludos,<br>
Equipo de {{ config('app.name') }}
@endcomponent
