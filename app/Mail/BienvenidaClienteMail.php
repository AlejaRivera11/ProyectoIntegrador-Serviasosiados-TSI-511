<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;


class BienvenidaClienteMail extends Mailable
{
    use Queueable, SerializesModels;

    public $nombreCliente;
    public $documento;
    public $passwordTemporal;

    public function __construct($nombreCliente, $documento, $passwordTemporal)
    {
        $this->nombreCliente    = $nombreCliente;
        $this->documento        = $documento;
        $this->passwordTemporal = $passwordTemporal;
    }

    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Bienvenido a Serviasociados - Credenciales de acceso',
        );
    }

    public function content(): Content
    {
        return new Content(
            view: 'emails.bienvenida',
        );
    }
}