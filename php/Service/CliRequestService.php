<?php

namespace MyApp\Service;

use Sid\Container\Service;

use Symfony\Component\HttpFoundation\Request;

use Sid\ArgvParser\ArgvParser;

class CliRequestService extends Service
{
    public function getName() : string
    {
        return "cliRequest";
    }

    public function isShared() : bool
    {
        return true;
    }

    public function resolve()
    {
        $argvParser = new ArgvParser(
            $_SERVER["argv"]
        );

        $request = Request::create(
            $argvParser->getUri(),
            "CLI",
            $argvParser->getParams()
        );

        return $request;
    }
}
