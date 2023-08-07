<?php

use App\Services\SectorService;
use App\Services\SectorServiceInterface;
use App\Services\UserService;
use App\Services\UserServiceInterface;
use Psr\Container\ContainerInterface;
use Slim\Views\Twig;

$builder = new \DI\ContainerBuilder();
$builder->addDefinitions([
    UserServiceInterface::class => \DI\autowire(UserService::class),
    SectorServiceInterface::class => \DI\autowire(SectorService::class),

    Twig::class => function (ContainerInterface $container) {
        $settings = $container->get('settings')['views'];
        return Twig::create($settings['path'], $settings['settings']);
    },

    PDO::class => function (ContainerInterface $container) {
        $settings = $container->get('settings')['connection'];
        try {
            $connection = new PDO(
                "mysql:host={$settings['host']};dbname={$settings['dbname']}",
                $settings['dbuser'],
                $settings['dbpass']
            );
            $connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            echo "Connection failed: " . $e->getMessage();
        }
        return $connection;
    }
]);

$container = $builder->build();

return $container;
