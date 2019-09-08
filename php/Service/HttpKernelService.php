<?php

namespace MyApp\Service;

use Sid\Container\Service;
use Sid\Framework\Dispatcher;
use Sid\Framework\Dispatcher\Path;
use Sid\Framework\Kernel;
use Sid\Framework\Router;
use Zend\Config\Config;

class HttpKernelService extends Service
{
    public function getName() : string
    {
        return "httpKernel";
    }

    public function isShared() : bool
    {
        return true;
    }

    public function resolve(Config $config, Router $router, Dispatcher $dispatcher)
    {
        $httpKernel = new Kernel(
            $router,
            $dispatcher
        );

        $httpKernel->setNotFoundPath(
            new Path(
                $config->router->notFound->controller,
                $config->router->notFound->action
            )
        );

        return $httpKernel;
    }
}
