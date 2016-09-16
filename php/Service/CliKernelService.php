<?php

namespace MyApp\Service;

use Sid\Container\Service;

use Sid\Framework\Router;
use Sid\Framework\Dispatcher;
use Sid\Framework\Dispatcher\Path;
use Sid\Framework\Kernel;

use Zend\Config\Config;

class CliKernelService extends Service
{
    public function getName() : string
    {
        return "cliKernel";
    }

    public function isShared() : bool
    {
        return true;
    }

    public function resolve(Config $config, Router $router, Dispatcher $dispatcher)
    {
        $cliKernel = new Kernel(
            $router,
            $dispatcher
        );

        $cliKernel->addReturnHandler(
            new \Sid\Framework\Kernel\ReturnHandler\ExitCode()
        );

        $cliKernel->setNotFoundPath(
            new Path(
                $config->router->notFound->controller,
                $config->router->notFound->action
            )
        );

        return $cliKernel;
    }
}
