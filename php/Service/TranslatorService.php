<?php

namespace MyApp\Service;

use Sid\Container\Service;

use Symfony\Component\HttpFoundation\Request;

use Symfony\Component\Translation\Translator;

use Zend\Config\Config;

use Symfony\Component\Translation\Loader\YamlFileLoader;

class TranslatorService extends Service
{
    public function getName() : string
    {
        return "translator";
    }

    public function isShared() : bool
    {
        return true;
    }

    public function resolve(Request $request, Config $config)
    {
        $translator = new Translator(
            $request->getPreferredLanguage()
        );



        $translator->addLoader(
            "yaml",
            new YamlFileLoader()
        );



        foreach ($config->translator->locales as $locale) {
            $translator->addResource(
                "yaml",
                "translations/" . $locale . ".yaml",
                $locale
            );
        }



        $translator->setFallbackLocales(
            $config->translator->fallbackLocales->toArray()
        );



        return $translator;
    }
}
