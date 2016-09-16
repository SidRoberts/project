<?php

namespace MyApp\Service;

use Sid\Container\Service;

use Sid\Framework\Router\RouteCollection;

use Zend\Config\Config;

class RouteCollectionService extends Service
{
    public function getName() : string
    {
        return "routeCollection";
    }

    public function isShared() : bool
    {
        return true;
    }

    public function resolve(Config $config, $annotations)
    {
        $routeCollection = new RouteCollection($annotations);

        $controllers = $config->router->controllers;

        foreach ($controllers as $controller) {
            $routeCollection->addController($controller);
        }

        return $routeCollection;
    }
}
