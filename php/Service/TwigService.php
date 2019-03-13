<?php

namespace MyApp\Service;

use Sid\Container\Service;

use Symfony\Bridge\Twig\Extension\TranslationExtension;
use Sid\TwigWhitelistedFunctions\WhitelistedFunctionsExtension;
use Sid\Url\Twig\UrlExtension;
use Sid\Flash\Twig\FlashExtension;

use Sid\Flash\Flash;

use Sid\Url\Url;

use Twig\Extension\DebugExtension;
use Twig\Loader\FilesystemLoader;

use Zend\Config\Config;

use Symfony\Component\Translation\Translator;

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

    public function resolve(Config $config, Translator $translator, Url $url, Flash $flash)
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

        $twig->addExtension(
            new TranslationExtension($translator)
        );



        $twig->addGlobal(
            "translatorLocales",
            $config->translator->locales->toArray()
        );



        return $twig;
    }
}
