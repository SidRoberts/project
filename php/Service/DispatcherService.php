<?php

namespace MyApp\Service;

use Sid\Container\Service;
use Sid\ContainerResolver\Resolver\SidContainer as Resolver;
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

    public function resolve(Resolver $resolver)
    {
        $dispatcher = new Dispatcher($resolver);

        return $dispatcher;
    }
}
