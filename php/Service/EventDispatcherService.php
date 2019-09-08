<?php

namespace MyApp\Service;

use Sid\Container\Service;
use Symfony\Component\EventDispatcher\EventDispatcher;

class EventDispatcherService extends Service
{
    public function getName() : string
    {
        return "eventDispatcher";
    }

    public function isShared() : bool
    {
        return true;
    }

    public function resolve()
    {
        $eventDispatcher = new EventDispatcher();

        return $eventDispatcher;
    }
}
