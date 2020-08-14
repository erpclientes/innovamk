<?php

namespace App\Http\Middleware;

use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken as Middleware;

class VerifyCsrfToken extends Middleware
{
    /**
     * The URIs that should be excluded from CSRF verification.
     *
     * @var array
     */
    protected $except = [
        'api/*',
        '/home',
        'hotspot',
        '/hotspot/login',
        '/hotspot/status',
        '/hotspot/logout',
        '/empresa/grabar2',
        '/licencia/registrar',
        '/licencia/validar',
        '/setLicencia',
        '/licencia/generador',
        '/licencia/generador3',
        '/DocumentoVenta/info',
        '/grabarCarrito',
    ];
}
