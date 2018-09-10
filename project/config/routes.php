<?php

// Get all consoles.
// POST Console

use Slim\Http\Request;
use Slim\Http\Response;
use Valitron\Validator;

use Illuminate\Support\Facades\DB;

$app->post('consoles/', function ($request) {

    echo "POST - Adding a console, I don't do anything just yet.";

});

$app->get('/consoles', function () {

    echo "GET - All consoles, I don't do anything just now.";

});

/**
 * ADD NEW GAME
 * SUCCESS : Returns 201 Created
 *  BODY : Id of the created record.
 * FAIL : Returns 400 BAD REQUEST
 */
$app->post('/games', function (Request $request, Response $response, $params) {

    $data = $request->getParsedBody();

    $validator = new Validator($data);
    $validator ->rule('required', 'game_name')->message('{field} is required')->label('Game Name');
    $validator->rule('required', 'console_code')->message('{field} is required')->label("Console Code");

    if (!$validator->validate()) {
        $data = array('status' => false,
            'errors' => $validator->errors());
        return $response->withJson($data, 400);
    }
    else {
        // If the validation has passed, we're safe to query params in the body itself and INSERT.

        $createdId = $this->get('db')->table('t_game')->insertGetId(
            ['name' => $data['game_name'], 'console_id' => $data['console_code']]
        );

        // Return the Auto Incremented ID that represents the created record.
        return $response->withJson(['game_id' => $createdId]);
    }
});

$app->delete('/games/{game_id}', function(Request $request, Response $response, array $args) {

    $gameId = $args['game_id'];

    $dbResponse = $this->db->table('t_game')->where('identity_game_id', '=', $gameId)->delete();

    if($dbResponse){
        return $response->withStatus(202);
    } else {
        return $response->withStatus(404);
    }
});

$app->get('/games', function (Request $request, Response $response) {

    $db = $this->get('db');

    $rows = $db->table('t_game')->get();

    return $response->withJson($rows);
});

$app->get('/findgame?console={console_id}', function (Request $request, Response $response) {

    $paramConsoleId = $request->get('console_id');

    $data = $this->get('db')->table('t_game')->select('*')->where('console_id', '=', $paramConsoleId);

    return $response->withJson($data);

});
