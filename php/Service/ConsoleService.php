<?php

namespace MyApp\Service;

use Exception;
use MyApp\Console\Command;
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
            if (!is_subclass_of($commandClassName, Command::class)) {
                throw new Exception(
                    sprintf(
                        "%s is not a subclass of %s",
                        $commandClassName,
                        Command::class
                    )
                );
            }

            $command = new $commandClassName($container);

            $console->add($command);
        }



        return $console;
    }
}
