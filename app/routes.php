<?php

declare(strict_types=1);

use App\Application\Actions\User\ListUsersAction;
use App\Application\Actions\User\ViewUserAction;
use App\Application\Middleware\LoadAfterMiddleware;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Slim\App;
use Slim\Interfaces\RouteCollectorProxyInterface as Group;
use Slim\Routing\RouteCollectorProxy;

return function (App $app) {
    $app->options('/{routes:.*}', function (Request $request, Response $response) {
        // CORS Pre-Flight OPTIONS Request Handler
        return $response;
    });

    $app->get('/', function (Request $request, Response $response) {
        $response->getBody()->write('Hello world!');
        return $response;
    });

    $app->group('/users', function (Group $group) {
        $group->get('', ListUsersAction::class);
        $group->get('/{id}', ViewUserAction::class);
    });

    $app->get('/user/id', function (Request $request, Response $response) {
        $response->getBody()->write('Hello world!');
        return $response;
    })->add(new LoadAfterMiddleware());

    $container = $app->getContainer();

    $app->group('', function (RouteCollectorProxy $view) {
        $view->get('/index/{name}', function ($request, $response, $args) {
            $name = $args['name'];

            return $this->get('view')->render($response, 'index.twig', compact('name'));
        });

        $view->get('/views/{name}', function ($request, $response, $args) {
            $view = 'index.twig';
            $name = $args['name'];

            return $this->get('view')->render($response, $view, compact('name'));
        });
    })->add($container->get('viewMiddleware'));
};
