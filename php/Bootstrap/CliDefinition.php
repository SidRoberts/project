<?php

namespace MyApp\Bootstrap;

use MyApp\BootstrapDefinition;

use Sid\Container\Container;

class CliDefinition extends BootstrapDefinition
{
    public function getEnvironment() : string
    {
        return "cli";
    }



    public function boot(Container $container)
    {
        $console = $container->get("console");

        $console->run();
    }
}
