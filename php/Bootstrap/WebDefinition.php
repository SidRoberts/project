<?php

namespace MyApp\Bootstrap;

use MyApp\BootstrapDefinition;

use Sid\Container\Container;

class WebDefinition extends BootstrapDefinition
{
    public function getEnvironment() : string
    {
        return "web";
    }



    public function boot(Container $container)
    {
        $kernel = $container->get("httpKernel");

        $request = $container->get("request");



        $response = $kernel->handle($request);

        $response->send();
    }
}
