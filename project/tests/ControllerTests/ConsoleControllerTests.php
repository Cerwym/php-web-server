<?php

namespace App\Test\ControllerTests;

use App\Test\BaseTest;

class ConsoleControllerTests extends BaseTest {

    /**
     * PLOC -: unmark this as a test, the second time this test is run, this will fail due to the DB's constraint on the code being unique.
     */
    public function create_console_when_data_valid_returns_201() {
        $payload = [
            'console_code' => 'STRN',
            'console_name' => 'Sega Saturn'
        ];

        $response = $this->request('POST', '/api/consoles', $payload);

        $this->assertEquals(201, $response->getStatusCode());
    }

    /** @test */
    public function create_console_with_no_console_code_returns_400() {
        $payload = [
            'console_name' => 'Sega Saturn'
        ];

        $response = $this->request('POST', '/api/consoles', $payload);
        $body = json_decode((string)$response->getBody(), true);

        $this->assertEquals(400, $response->getStatusCode());
        $this->assertArrayHasKey('console_code', $body['errors']);
    }

    /** @test */
    public function create_console_with_no_name_returns_400() {
        $payload = [
            'console_code' => 'STRN'
        ];

        $response = $this->request('POST', '/api/consoles', $payload);
        $body = json_decode((string)$response->getBody(), true);

        $this->assertEquals(400, $response->getStatusCode());
        $this->assertArrayHasKey('console_name', $body['errors']);
    }

}