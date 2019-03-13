<?php

namespace MyApp\Tests\Unit\Controller;

use Symfony\Component\HttpFoundation\Request;

class ErrorControllerTest extends \Codeception\TestCase\Test
{
    /**
     * @var \UnitTester
     */
    protected $tester;

    protected function _before()
    {
        $bootstrap = new \MyApp\Bootstrap();

        $this->container = $bootstrap->getContainer();
    }

    protected function _after()
    {
    }



    public function testError500StatusCode()
    {
        $httpKernel = $this->container->get("httpKernel");



        $request = Request::create(
            "/error/500",
            "GET"
        );



        $response = $httpKernel->handle($request);

        $this->assertEquals(
            500,
            $response->getStatusCode()
        );
    }
}
