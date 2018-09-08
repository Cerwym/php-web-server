<?php

use Slim\Container;

$container = $app->getContainer();

$container['environment'] = function () {
    $scriptName = $_SERVER['SCRIPT_NAME'];
    $_SERVER['SCRIPT_NAME'] = dirname(dirname($scriptName)) . '/' . basename($scriptName);
    return new Slim\Http\Environment($_SERVER);
};

$container['pdo'] = function (Container $container) {
    $settings = $container->get('settings');

    $host = $settings['db']['host'];
    $dbname = $settings['db']['database'];
    $username = $settings['db']['username'];
    $password = $settings['db']['password'];
    $charset = $settings['db']['charset'];
    $collate = $settings['db']['collation'];

    $dsn = "mysql:host=$host;dbname=$dbname;charset=$charset";

    $options = [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_PERSISTENT => false,
        PDO::ATTR_EMULATE_PREPARES => false,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
        PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES $charset COLLATE $collate"
    ];

    return new PDO($dsn, $username, $password, $options);
};