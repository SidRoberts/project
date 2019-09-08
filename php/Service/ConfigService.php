<?php

namespace MyApp\Service;

use Sid\Container\Service;
use Symfony\Component\Yaml\Yaml;
use Zend\Config\Config;

class ConfigService extends Service
{
    public function getName() : string
    {
        return "config";
    }

    public function isShared() : bool
    {
        return true;
    }

    public function resolve()
    {
        $config = new Config(
            Yaml::parse(
                file_get_contents(
                    "config.yaml"
                )
            )
        );

        return $config;
    }
}
