<?php

$settings = [];

// Slim settings
$settings['displayErrorDetails'] = true;
$settings['determineRouteBeforeAppMiddleware'] = true;

// Path settings
$settings['root'] = dirname(__DIR__);
$settings['temp'] = $settings['root'] . '/tmp';
$settings['public'] = $settings['root'] . '/public';

// PLOC - Custom View Display, will look at.
// View settings
$settings['twig'] = [
    'path' => $settings['root'] . '/templates',
    'cache_enabled' => false,
    'cache_path' =>  $settings['temp'] . '/twig-cache'
];

// Database settings
$settings['db']['host'] = 'localhost';
$settings['db']['username'] = 'root';
$settings['db']['password'] = '';
$settings['db']['database'] = 'boundary_tech_game';
$settings['db']['charset'] = 'utf8';
$settings['db']['collation'] = 'utf8_unicode_ci';

return $settings;