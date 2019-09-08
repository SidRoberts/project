<?php

namespace MyApp\Service;

use Doctrine\Common\Annotations\AnnotationReader;
use Doctrine\Common\Annotations\FileCacheReader;
use Sid\Container\Service;
use Zend\Config\Config;

class AnnotationsService extends Service
{
    public function getName() : string
    {
        return "annotations";
    }

    public function isShared() : bool
    {
        return true;
    }

    public function resolve(Config $config)
    {
        $reader = new AnnotationReader();

        if (isset($config->annotations->cache)) {
            $reader = new FileCacheReader(
                $reader,
                $config->annotations->cache,
                $config->isDevMode
            );
        }

        return $reader;
    }
}
