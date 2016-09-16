<?php

namespace MyApp\Service;

use Sid\Container\Container;
use Sid\Container\Service;

use Sid\Framework\Dispatcher;

class DispatcherService extends Service
{
    public function getName() : string
    {
        return "dispatcher";
    }

    public function isShared() : bool
    {
        return true;
    }

    public function resolve(Container $container)
    {
        $dispatcher = new Dispatcher($container);

        return $dispatcher;
    }
}
