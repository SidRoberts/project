<?php

namespace MyApp\Service;

use Doctrine\ORM\EntityManager;
use Sid\Container\Service;
use Zend\Config\Config;

class DoctrineService extends Service
{
    public function getName() : string
    {
        return "doctrine";
    }

    public function isShared() : bool
    {
        return true;
    }

    public function resolve(Config $config)
    {
        $doctrineConfig = \Doctrine\ORM\Tools\Setup::createAnnotationMetadataConfiguration(
            [
                "php/Model/",
            ],
            $config->isDevMode
        );

        $entityManager = EntityManager::create(
            $config->doctrine->toArray(),
            $doctrineConfig
        );

        return $entityManager;
    }
}
