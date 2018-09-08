<?php

// POST a new entry.
// GET game by ID
// GET game by consoles


$slim->post('/games', function ($request) {

    echo "POST - don't do anything just yet.";

});

$slim->get('/games', function () {

    echo "GET - games by ID, don't do anything just yet.";

});

$slim->get('/games?console={console_id}', function ($request) {

    echo "GET - games by ID, don't do anything just yet.";

});
