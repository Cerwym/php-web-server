<?php
/**
 * Created by PhpStorm.
 * User: cerwy
 * Date: 10/09/2018
 * Time: 15:16
 */

namespace App\GameService\Controllers;

use Interop\Container\ContainerInterface;
use Slim\Http\Request;
use Slim\Http\Response;
use Valitron\Validator;

class ConsoleController {

    protected $db;

    public function __construct(ContainerInterface $container) {
        $this->db = $container->get('db');
    }

    public function getAll(Request $request, Response $response) {
        return $response->withJson($this->db->table('t_console')->get());
    }

    public function create(Request $request, Response $response) {

        $data = $request->getParsedBody();

        $validator = new Validator($data);

        $validator->rule('required', 'console_code')->message('{field} is required')->label('A Unique Console Code');
        $validator->rule('required', 'console_name')->message('{field} is required')->label("A Display Name");

        if (!$validator->validate()) {
            $data = array('status' => false,
                'errors' => $validator->errors());
            return $response->withJson($data, 400);
        }
        else {
            // If the validation has passed, we're safe to query params in the body itself and INSERT.

            if (!$this->db->table('t_console')->insert(
                ['pk_console_id' => $data['console_code'], 'name' => $data['console_name']]
            )) {
                // Find a good way of getting the error out.
                // The error message will be an integrity constraint.
                echo "There was a problem adding.";
            };
        }

        return $response->withStatus(201);
    }

    public function delete(Request $request, Response $response) {
        echo "At some point i'll be a real thing.";
    }
}