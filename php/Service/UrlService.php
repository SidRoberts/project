<?php

namespace MyApp\Service;

use Sid\Container\Service;

use Sid\Url\Url;

use Zend\Config\Config;

class UrlService extends Service
{
    public function getName() : string
    {
        return "url";
    }

    public function isShared() : bool
    {
        return true;
    }

    public function resolve(Config $config)
    {
        $url = new Url(
            $config->url->baseUri
        );

        return $url;
    }
}
