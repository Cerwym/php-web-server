<?php

// Get all consoles.
// POST Console

$app->post('consoles/', function ($request) {

    echo "POST - Adding a console, I don't do anything just yet.";

});

$app->get('/consoles', function () {

    echo "GET - All consoles, I don't do anything just now.";

});

$app->post('/games', function ($request) {

    echo "POST - don't do anything just yet.";

});

$app->get('/games', function () {

    echo "GET - Get all games, dont do anything just yet.";
});

$app->get('/games?console={console_id}', function ($request) {

    echo "GET - games by ID, don't do anything just yet.";

});
