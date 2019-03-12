<?php

namespace MyApp\Service;

use Sid\Container\Service;

use Sid\Container\Container;

use Zend\Config\Config;

use Symfony\Component\Console\Application;

class ConsoleService extends Service
{
    public function getName() : string
    {
        return "console";
    }

    public function isShared() : bool
    {
        return true;
    }

    public function resolve(Config $config, Container $container)
    {
        $console = new Application();




        $commands = $config->console->commands;

        foreach ($commands as $command) {
            $helloWorldCommand = new $command();

            $helloWorldCommand->setContainer($container);

            $console->add($helloWorldCommand);
        }



        return $console;
    }
}
