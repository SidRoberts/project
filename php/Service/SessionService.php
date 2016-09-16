<?php

namespace MyApp\Service;

use Sid\Container\Service;

use Symfony\Component\HttpFoundation\Session\Session;

class SessionService extends Service
{
    public function getName() : string
    {
        return "session";
    }

    public function isShared() : bool
    {
        return true;
    }

    public function resolve()
    {
        $session = new Session();

        return $session;
    }
}
