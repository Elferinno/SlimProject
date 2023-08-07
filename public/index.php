<?php

use Slim\Views\Twig;
use Slim\Views\TwigMiddleware;

$app = require __DIR__ . '/../app/bootstrap.php';
require __DIR__ . '/../vendor/autoload.php';

$twig = $app->getContainer()->get(Twig::class);

$app->add(TwigMiddleware::create($app, $twig));

$app->run();
