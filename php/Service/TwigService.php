<?php

namespace MyApp\Service;

use Sid\Container\Service;

use Twig_Loader_Filesystem;
use Twig_Environment;
use Twig_Extension_Debug;
use Twig_SimpleFunction;

use Symfony\Bridge\Twig\Extension\TranslationExtension;
use Sid\TwigWhitelistedFunctions\WhitelistedFunctionsExtension;
use Sid\Url\Twig\UrlExtension;
use Sid\Flash\Twig\FlashExtension;

use Sid\Flash\Flash;

use Sid\Url\Url;

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
        $loader = new Twig_Loader_Filesystem(
            $config->twig->viewsDir
        );

        $twig = new Twig_Environment(
            $loader,
            $config->twig->options->toArray()
        );



        $twig->addExtension(
            new Twig_Extension_Debug()
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
