<?php

// Get all consoles.
// POST Console

use Slim\Http\Request;
use Slim\Http\Response;

use Illuminate\Database\Connection;

$app->post('consoles/', function ($request) {

    echo "POST - Adding a console, I don't do anything just yet.";

});

$app->get('/consoles', function () {

    echo "GET - All consoles, I don't do anything just now.";

});

$app->post('/games', function ($request) {

    echo "POST -> Create new game, i dont do anything yet.";

});

$app->get('/games', function (Request $request, Response $response) {

    $db = $this->get('db');

    $rows = $db->table('t_game')->get();

    return $response->withJson($rows);
});

$app->get('/games?console={console_id}', function ($request) {

    echo "GET - games by ID, don't do anything just yet.";

});
