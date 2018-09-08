<?php

// Get all consoles.
// POST Console

$slim->post('consoles/', function ($request) {

    echo "POST - Adding a console, I don't do anything just yet.";

});

$slim->get('/consoles', function () {

    echo "GET - All consoles, I don't do anything just now.";

});