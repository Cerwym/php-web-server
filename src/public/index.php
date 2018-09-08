<?php

require '../vendor/autoload.php';

$slim = new \Slim\App;

// Recursively add each php file under 'routes' so that we can add as many as needed without maintaining this.
foreach (glob("../app/api/routes/*.php") as $filename) {
    require_once ($filename);
}

$slim->run();