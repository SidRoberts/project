<?php

namespace MyApp\Service;

use Sid\Container\Service;
use Sid\ContainerResolver\Resolver\SidContainer as Resolver;
use Sid\Framework\Router;
use Sid\Framework\Router\RouteCollection;

class RouterService extends Service
{
    public function getName() : string
    {
        return "router";
    }

    public function isShared() : bool
    {
        return true;
    }

    public function resolve(Resolver $resolver, RouteCollection $routeCollection)
    {
        $router = new Router($resolver, $routeCollection);

        return $router;
    }
}
