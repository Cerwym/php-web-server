<?php
/**
 * Created by PhpStorm.
 * User: cerwy
 * Date: 10/09/2018
 * Time: 17:03
 */

namespace App\Test\ControllerTests;

use App\Test\BaseTest;

class GameControllerTests extends BaseTest {

    /** @test */
    public function create_game_when_data_isValid_returns_201created() {

        $payload = [
            'game_name' => 'Super Mario Brothers 3',
            'console_code' => 'NES'
            ];

        $response = $this->request('POST', '/api/games', $payload);
        $this->assertEquals(201, $response->getStatusCode());
    }

    /** @test */
    public function create_game_with_no_console_code_returns_400badrequest() {
        $payload = [
            'game_name' => 'Super Mario Brothers 3'
        ];

        $response = $this->request('POST', '/api/games', $payload);
        // The api will return a JSON error body, we should be able to read this and check to see if the matched name is in errror.
        $body = json_decode((string)$response->getBody(), true);

        $this->assertEquals(400, $response->getStatusCode());
        $this->assertArrayHasKey('console_code', $body['errors']);
    }

    /** @test */
    public function create_game_with_no_name_returns_400badrequest() {
        $payload = [
            'console_code' => 'SNES'
        ];

        $response = $this->request('POST', '/api/games', $payload);
        $body = json_decode((string)$response->getBody(), true);

        $this->assertEquals(400, $response->getStatusCode());
        $this->assertArrayHasKey('game_name', $body['errors']);
    }

    /** @test */
    public function get_game_by_id_isValid_returns_data() {

        $response = $this->request('GET', '/api/games/1');
        $body = json_decode((string)$response->getBody(), true);

        $this->assertEquals(200, $response->getStatusCode());
        $this->assertArrayHasKey('name', $body);
        $this->assertArrayHasKey('console_id', $body);

        $this->assertEquals('Super Metroid', $body['name']);
        $this->assertEquals('SNES', $body['console_id']);
    }

    public function get_game_by_id_isInvalid_returns_404() {

        $response = $this->request('GET', '/api/games/9999999');
        $this->assertEquals(404, $response->getStatusCode());
    }
}