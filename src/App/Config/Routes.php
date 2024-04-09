<?php

namespace App\Config;

use Framework\App;
use App\Controllers\HomeController;
use App\Controllers\AboutController;
use App\Controllers\RegisterController;

function registerRoutes(App $app)
{
    $app->get('/', [HomeController::class, 'home']);
    $app->get('/about', [AboutController::class, 'about']);
    $app->get('/register', [RegisterController::class, 'registerView']);
    $app->post('/register', [RegisterController::class, 'register']);
    $app->get('/login', [RegisterController::class, 'loginView']);
    $app->post('/login', [RegisterController::class, 'login']);
}
