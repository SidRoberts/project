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
        $bootstrapDefintion = new \MyApp\Bootstrap\WebDefinition();

        $bootstrap = new \MyApp\Bootstrap($bootstrapDefintion);

        $this->container = $bootstrap->createContainer();
    }

    protected function _after()
    {
    }



    public function testError500StatusCode()
    {
        $container = $this->container;

        $httpKernel = $container->get("httpKernel");



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
