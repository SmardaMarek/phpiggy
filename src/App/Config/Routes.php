<?php

namespace App\Config;

use Framework\App;
use App\Controllers\HomeController;
use App\Controllers\AboutController;
use App\Controllers\RegisterController;
use App\Controllers\TransactionController;
use App\Controllers\ReceiptController;
use App\Middleware\AuthRequiredMiddleware;
use App\Middleware\GuestOnlyMiddleware;

function registerRoutes(App $app)
{
    $app->get('/', [HomeController::class, 'home'])->add(AuthRequiredMiddleware::class);
    $app->get('/about', [AboutController::class, 'about']);
    $app->get('/register', [RegisterController::class, 'registerView'])->add(GuestOnlyMiddleware::class);
    $app->post('/register', [RegisterController::class, 'register'])->add(GuestOnlyMiddleware::class);
    $app->get('/login', [RegisterController::class, 'loginView'])->add(GuestOnlyMiddleware::class);
    $app->post('/login', [RegisterController::class, 'login'])->add(GuestOnlyMiddleware::class);
    $app->get('/logout', [RegisterController::class, 'logout'])->add(AuthRequiredMiddleware::class);
    $app->get('/transactions', [TransactionController::class, 'createView'])->add(AuthRequiredMiddleware::class);
    $app->post('/transactions', [TransactionController::class, 'create'])->add(AuthRequiredMiddleware::class);
    $app->get('/transactions/{transaction}', [TransactionController::class, 'editView'])->add(AuthRequiredMiddleware::class);
    $app->post('/transactions/{transaction}', [TransactionController::class, 'edit'])->add(AuthRequiredMiddleware::class);
    $app->delete('/transactions/{transaction}', [TransactionController::class, 'delete'])->add(AuthRequiredMiddleware::class);
    $app->get('/transactions/{transaction}/receipt', [ReceiptController::class, 'uploadView'])->add(AuthRequiredMiddleware::class);
    $app->post('/transactions/{transaction}/receipt', [ReceiptController::class, 'upload'])->add(AuthRequiredMiddleware::class);
    $app->get('/transactions/{transaction}/receipt/{receipt}', [ReceiptController::class, 'download'])->add(AuthRequiredMiddleware::class);
    $app->delete('/transactions/{transaction}/receipt/{receipt}', [ReceiptController::class, 'delete'])->add(AuthRequiredMiddleware::class);
}
