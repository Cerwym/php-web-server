<?php

// Get all consoles.
// POST Console

use App\GameService\Controllers\GameController;
use App\GameService\Controllers\ConsoleController;

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

});