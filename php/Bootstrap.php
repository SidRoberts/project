<?php

namespace MyApp;

use Sid\Container\Container;

class Bootstrap
{
    /**
     * @var Container
     */
    protected $container;



    public function __construct()
    {
        $this->container = ContainerBuilder::build();
    }




    public function getContainer() : Container
    {
        return $this->container;
    }



    public function web()
    {
        $httpKernel = $this->container->get("httpKernel");
        $request    = $this->container->get("request");



        $response = $httpKernel->handle($request);

        $response->send();
    }

    public function cli()
    {
        $console = $this->container->get("console");

        $console->run();
    }
}
