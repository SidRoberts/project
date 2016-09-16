<?php

namespace MyApp\Service;

use Sid\Container\Service;

use Symfony\Component\Console\Output\ConsoleOutput;

class CliOutputService extends Service
{
    public function getName() : string
    {
        return "cliOutput";
    }

    public function isShared() : bool
    {
        return true;
    }

    public function resolve()
    {
        $cliOutput = new ConsoleOutput();

        return $cliOutput;
    }
}
