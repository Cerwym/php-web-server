<?php
/**
 * Created by PhpStorm.
 * User: cerwy
 * Date: 10/09/2018
 * Time: 14:23
 */

namespace App\GameService\Controllers;

use Illuminate\Support\Facades\DB;
use Interop\Container\ContainerInterface;
use Slim\Http\Request;
use Slim\Http\Response;
use Valitron\Validator;

class GameController {

    protected $db;

    public function __construct(ContainerInterface $container) {
        $this->db = $container->get('db');
    }

    public function create(Request $request, Response $response) {
        $data = $request->getParsedBody();

        $validator = new Validator($data);

        $validator->rule('required', 'game_name')->message('{field} is required')->label('Game Name');
        $validator->rule('required', 'console_code')->message('{field} is required')->label("Console Code");

        if (!$validator->validate()) {
            $data = array('status' => false,
                'errors' => $validator->errors());
            return $response->withJson($data, 400);
        }
        else {
            // If the validation has passed, we're safe to query params in the body itself and INSERT.

            $createdId = $this->db->table('t_game')->insertGetId(
                ['name' => $data['game_name'], 'console_id' => $data['console_code']]
            );

            // Return the Auto Incremented ID that represents the created record.
            return $response->withJson(['game_id' => $createdId], 201);
        }
    }

    public function getById(Request $request, Response $response, array $args) {

        $dbResponse = $this->getByIdResponse($args['game_id'])->first();

        if ($dbResponse != null) {
            return $response->withJson($dbResponse);
        } else {
            return $response->withStatus(404);
        }
    }

    public function getAll(Request $request, Response $response) {
        return $response->withJson($this->db->table('t_game')->get(), 200);
    }

    /**
     * @param Request $request
     * @param Response $response
     * @param array $args
     * @return Response 202 If record is deleted, 404 if ID is note found
     */
    public function delete(Request $request, Response $response, array $args) {

        $dbResponse = $this->getByIdResponse($args['game_id'])->delete();

        if($dbResponse){
            return $response->withStatus(202);
        } else {
            return $response->withStatus(404);
        }
    }

    private function getByIdResponse($id) {
        return $dbResponse = $this->db->table('t_game')->where('identity_game_id', '=', $id);
    }

}