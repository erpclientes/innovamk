<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class Comprobante extends Mailable
{
    use Queueable, SerializesModels;

    public $factura,$cliente,$servicio,$notificaciones,$empresa,$dfactura;

    public function __construct($factura,$cliente,$servicio,$notificaciones,$empresa,$dfactura)
    {
        $this->factura      = $factura;
        $this->cliente      = $cliente;
        $this->servicio     = $servicio;
        $this->notificaciones = $notificaciones;
        $this->empresa      = $empresa;
        $this->dfactura     = $dfactura;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $nombre = null;
        foreach ($this->cliente as $value) {
            $nombre = $value->nombres;
        }
         return $this->subject('Bienvenido Sr(a) '.$nombre)                
                    ->markdown('forms.comprobante.PDF.plantilla');
    }
}
