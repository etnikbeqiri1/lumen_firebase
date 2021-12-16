<?php

namespace App\Http;

use Symfony\Component\HttpKernel\HttpKernel;

class Kernel extends HttpKernel
{


    protected $routeMiddleware = [
        'firebase' => \App\Http\Middleware\FirebaseMiddleware::class,
    ];
}
