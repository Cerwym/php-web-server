<?php

// Get all consoles.
// POST Console

use App\GameService\Controllers\GameController;
use App\GameService\Controllers\ConsoleController;

use Slim\Http\Request;
use Slim\Http\Response;

// Group up all publicly exposed APIs
$app->group('/api', function () {

    // All routes under '/games'
    $this->get('/games', GameController::class . ':getAll')->setName('games.getAll');
    $this->get('/games/{game_id}', GameController::class . ':getById')->setName('games.getById');
    $this->delete('/games/{game_id}', GameController::class . ':delete')->setName('games.delete');
    $this->post('/games', GameController::class . ':create')->setName('games.add');

    // All routes under '/consoles'
    $this->get('/consoles', ConsoleController::class . ':getAll')->setName('consoles.getAll');
    $this->post('/consoles', ConsoleController::class . ':create')->setName('consoles.add');

    // ToDo: Do something cool with this one like cascade down.
    // $this->delete('/consoles/{console_id}', ConsoleController::class . 'delete')->setName('consoles.delete');

});

/*
 * TODO: Need to figure out how to do this one in SLIM.
 */
$app->get('/findgame?console={console_id}', function (Request $request, Response $response) {

    $paramConsoleId = $request->get('console_id');

    $data = $this->get('db')->table('t_game')->select('*')->where('console_id', '=', $paramConsoleId);

    return $response->withJson($data);

});
