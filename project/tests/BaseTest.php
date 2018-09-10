<?php

namespace App\Test;

use PHPUnit\Framework\TestCase;
use Slim\Http\Environment;
use Slim\Http\Request;
use Slim\Http\Response;

abstract class BaseTest extends TestCase {

    protected $app;

    protected function setUp() {
        parent::setUp();
        $this->app = $this->createApp();
    }

    protected function createApp() {
        return require __DIR__ . '/../config/bootstrap.php';
    }

    public function runApp($requestMethod, $requestUri, $requestData = null, $headers = []){

        $environment = Environment::mock(
            array_merge(
                [
                    'REQUEST_METHOD'    => $requestMethod,
                    'REQUEST_URI'       => $requestUri,
                    'Content-Type'      => 'application/json'
                ],
                $headers
            )
        );

        $request = Request::createFromEnvironment($environment);

        if (isset($requestData)) {
            $request = $request->withParsedBody($requestData);
        }

        $response = new Response();

        return $this->app->process($request, $response);

    }

    public function request($requestMethod, $requestUri, $requestData = null, $headers =[]) {
        return $this->runApp($requestMethod, $requestUri, $requestData, $headers);
    }

}