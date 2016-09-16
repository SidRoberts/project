<?php

namespace MyApp\Service;

use Sid\Container\Service;

use Sid\Flash\Flash;
use Sid\Flash\Formatter\Html as HtmlFormatter;

use Symfony\Component\HttpFoundation\Session\Session;

class FlashService extends Service
{
    public function getName() : string
    {
        return "flash";
    }

    public function isShared() : bool
    {
        return true;
    }

    public function resolve(Session $session)
    {
        $formatter = new HtmlFormatter();

        $flash = new Flash(
            $session,
            $formatter
        );

        return $flash;
    }
}
