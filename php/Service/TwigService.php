<?php

namespace MyApp\Service;

use Sid\Container\Service;

use Sid\TwigWhitelistedFunctions\WhitelistedFunctionsExtension;
use Sid\Url\Twig\UrlExtension;
use Sid\Flash\Twig\FlashExtension;

use Sid\Flash\Flash;

use Sid\Url\Url;

use Twig\Extension\DebugExtension;
use Twig\Loader\FilesystemLoader;

use Zend\Config\Config;

class TwigService extends Service
{
    public function getName() : string
    {
        return "twig";
    }

    public function isShared() : bool
    {
        return false;
    }

    public function resolve(Config $config, Url $url, Flash $flash)
    {
        $loader = new FilesystemLoader(
            $config->twig->viewsDir
        );

        $twig = new \Twig\Environment(
            $loader,
            $config->twig->options->toArray()
        );



        $twig->addExtension(
            new DebugExtension()
        );

        $twig->addExtension(
            new WhitelistedFunctionsExtension(
                $config->twig->whitelistedFunctions->toArray()
            )
        );

        $twig->addExtension(
            new UrlExtension($url)
        );

        $twig->addExtension(
            new FlashExtension($flash)
        );



        return $twig;
    }
}
