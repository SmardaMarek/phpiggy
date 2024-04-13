<?php

namespace App\Config;

use Framework\App;
use App\Middleware\TemplateDataMiddleware;
use App\Middleware\ValidationExceptionMiddleware;
use App\Middleware\SessionMiddleware;
use App\Middleware\FlashMiddleware;
use App\Middleware\CsrfTokenMiddleware;
use App\Middleware\CsrfGuardMiddleware;

function registerMiddleware(App $app)
{
    $app->addMiddleware(CsrfGuardMiddleware::class);
    $app->addMiddleware(CsrfTokenMiddleware::class);
    $app->addMiddleware(TemplateDataMiddleware::class);
    $app->addMiddleware(ValidationExceptionMiddleware::class);
    $app->addMiddleware(FlashMiddleware::class);
    $app->addMiddleware(SessionMiddleware::class);
}
