<?php

namespace MyApp\Service;

use Sid\Container\Container;
use Sid\Container\Service;

use Symfony\Component\Console\Application;

use Zend\Config\Config;

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

        foreach ($commands as $commandClassName) {
            $command = new $commandClassName();

            $command->setContainer($container);

            $console->add($command);
        }



        return $console;
    }
}
