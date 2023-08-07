<?php

declare(strict_types=1);

use DI\Container;

return function (Container $container) {
    $container->set('settings', function () {
        return [
            'name' => 'Slim Application',
            'displayErrorDetails' => true,
            'logErrorDetails' => true,
            'logErrors' => true,
            'views' => [
                'path' => __DIR__ . '/../src/Views',
                'settings' => ['cache' => false],
            ],
            'connection' => [
                'host' => 'docker-db-1',
                'dbname' => 'db',
                'dbuser' => 'user',
                'dbpass' => 'secret',
            ]
        ];
    });
};
