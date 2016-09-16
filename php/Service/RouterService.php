<?php

namespace MyApp\Service;

use Sid\Container\Container;
use Sid\Container\Service;

use Sid\Framework\Router;
use Sid\Framework\Router\RouteCollection;

use Zend\Config\Config;

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

    public function resolve(Container $container, RouteCollection $routeCollection)
    {
        $router = new Router($container, $routeCollection);

        return $router;
    }
}
