<?php

use Slim\Container;

// For DB Expression Builder
use Illuminate\Database\Connectors\ConnectionFactory;

$container = $app->getContainer();

$container['environment'] = function () {
    $scriptName = $_SERVER['SCRIPT_NAME'];
    $_SERVER['SCRIPT_NAME'] = dirname(dirname($scriptName)) . '/' . basename($scriptName);
    return new Slim\Http\Environment($_SERVER);
};

$container['db'] = function (Container $container) {
    $settings = $container->get('settings');

    $config = [
        'driver' => 'mysql',
        'host' => $settings['db']['host'],
        'database' => $settings['db']['database'],
        'username' => $settings['db']['username'],
        'password' => $settings['db']['password'],
        'charset' => $settings['db']['charset'],
        'collation' => $settings['db']['collation'],
    ];

    $factory = new ConnectionFactory(new \Illuminate\Container\Container());

    return $factory->make($config);
};

$container['pdo'] = function (Container $container) {
    return $container->get('db')->getPdo();
};

