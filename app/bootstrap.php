<?php

declare(strict_types=1);

use DI\Bridge\Slim\Bridge;

require __DIR__ . '/../vendor/autoload.php';

$container = require __DIR__ . '/../config/dependencies.php';

$settings = require __DIR__ . '/../app/settings.php';
$settings($container);

// Create App
$app = Bridge::create($container);

$middleware = require __DIR__ . '/../app/middleware.php';
$middleware($app);

$routes = require __DIR__ . '/../app/routes.php';
$routes($app);

return $app;
