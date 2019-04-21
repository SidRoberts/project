<?php

namespace Tests\Controller;

use MyApp\Bootstrap;
use Symfony\Component\HttpFoundation\Request;
use Tests\UnitTester;

class ErrorControllerCest
{
    public function error500StatusCode(UnitTester $I)
    {
        $bootstrap = new Bootstrap();

        $container = $bootstrap->getContainer();



        $httpKernel = $container->get("httpKernel");



        $request = Request::create(
            "/error/500",
            "GET"
        );



        $response = $httpKernel->handle($request);

        $I->assertEquals(
            500,
            $response->getStatusCode()
        );
    }
}
