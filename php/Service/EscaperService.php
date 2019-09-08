<?php

namespace MyApp\Service;

use Sid\Container\Service;
use Zend\Escaper\Escaper;

class EscaperService extends Service
{
    public function getName() : string
    {
        return "escaper";
    }

    public function isShared() : bool
    {
        return true;
    }

    public function resolve()
    {
        $escaper = new Escaper("utf-8");

        return $escaper;
    }
}
