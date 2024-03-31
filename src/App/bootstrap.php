<?php

declare(strict_types=1);

require __DIR__ . '/../../vendor/autoload.php';

use Framework\App;
use function App\Config\{registerRoutes, registerMiddleware};
use App\Config\Paths;
use Dotenv\Dotenv;

$dotenv = Dotenv::createImmutable(Paths::getRootPath());
$dotenv->load();

$app = new App(Paths::getSourcePath() . "App/container-definitions.php");

registerRoutes($app);
registerMiddleware($app);
return $app;
