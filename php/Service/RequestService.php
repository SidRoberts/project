<?php

namespace MyApp\Service;

use Sid\Container\Service;
use Symfony\Component\HttpFoundation\Request;

class RequestService extends Service
{
    public function getName() : string
    {
        return "request";
    }

    public function isShared() : bool
    {
        return true;
    }

    public function resolve()
    {
        $request = Request::createFromGlobals();

        return $request;
    }
}
