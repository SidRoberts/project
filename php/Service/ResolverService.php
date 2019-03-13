<?php

namespace MyApp\Service;

use Sid\ContainerResolver\Resolver\SidContainer as Resolver;

use Sid\Container\Container;
use Sid\Container\Service;

class ResolverService extends Service
{
    public function getName() : string
    {
        return "resolver";
    }

    public function isShared() : bool
    {
        return true;
    }

    public function resolve(Container $container)
    {
        $resolver = new Resolver($container);

        return $resolver;
    }
}
