<?php

namespace MyApp;

use Sid\Container\Container;

use MyApp\Service\AnnotationsService;
use MyApp\Service\CacheService;
use MyApp\Service\ConfigService;
use MyApp\Service\ConsoleService;
use MyApp\Service\DispatcherService;
use MyApp\Service\DoctrineService;
use MyApp\Service\EscaperService;
use MyApp\Service\EventDispatcherService;
use MyApp\Service\FlashService;
use MyApp\Service\FlysystemService;
use MyApp\Service\HttpKernelService;
use MyApp\Service\MonologService;
use MyApp\Service\PheanstalkService;
use MyApp\Service\RedisService;
use MyApp\Service\RequestService;
use MyApp\Service\ResolverService;
use MyApp\Service\RouterService;
use MyApp\Service\RouteCollectionService;
use MyApp\Service\SessionService;
use MyApp\Service\SlugifyService;
use MyApp\Service\TwigService;
use MyApp\Service\UrlService;

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
            FlysystemService::class,
            HttpKernelService::class,
            MonologService::class,
            PheanstalkService::class,
            RedisService::class,
            RequestService::class,
            ResolverService::class,
            RouterService::class,
            RouteCollectionService::class,
            SessionService::class,
            SlugifyService::class,
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
