<?php

declare(strict_types=1);

use App\Controller\HomeController;
use Slim\App;

return function (App $app) {

    $app->get('/', [HomeController::class, 'index']);

    $app->post('/sector-form-submit', [HomeController::class, 'form']);
};
