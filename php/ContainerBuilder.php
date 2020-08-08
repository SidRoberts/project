<?php

namespace MyApp;

use MyApp\Service\AnnotationsService;
use MyApp\Service\CacheService;
use MyApp\Service\ConfigService;
use MyApp\Service\ConsoleService;
use MyApp\Service\DispatcherService;
use MyApp\Service\DoctrineService;
use MyApp\Service\EscaperService;
use MyApp\Service\EventDispatcherService;
use MyApp\Service\FlashService;
use MyApp\Service\HttpKernelService;
use MyApp\Service\MonologService;
use MyApp\Service\PheanstalkService;
use MyApp\Service\RedisService;
use MyApp\Service\RequestService;
use MyApp\Service\ResolverService;
use MyApp\Service\RouteCollectionService;
use MyApp\Service\RouterService;
use MyApp\Service\SessionService;
use MyApp\Service\TwigService;
use MyApp\Service\UrlService;
use Sid\Container\Container;

class ContainerBuilder
{
    public static function build() : Container
    {
        $container = new Container();

        $serviceClasses = [
            AnnotationsService::class,
            CacheService::class,
            ConfigService::class,
            ConsoleService::class,
            DispatcherService::class,
            DoctrineService::class,
            EscaperService::class,
            EventDispatcherService::class,
            FlashService::class,
            HttpKernelService::class,
            MonologService::class,
            PheanstalkService::class,
            RedisService::class,
            RequestService::class,
            ResolverService::class,
            RouterService::class,
            RouteCollectionService::class,
            SessionService::class,
            TwigService::class,
            UrlService::class,
        ];

        foreach ($serviceClasses as $serviceClass) {
            $container->add(
                new $serviceClass()
            );
        }

        return $container;
    }
}
