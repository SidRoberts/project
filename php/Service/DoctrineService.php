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
            [
                "driver"   => "pdo_pgsql",
                "host"     => getenv("POSTGRES_HOST"),
                "user"     => getenv("POSTGRES_USER"),
                "password" => getenv("POSTGRES_PASSWORD"),
                "dbname"   => getenv("POSTGRES_DB"),
            ],
            $doctrineConfig
        );

        return $entityManager;
    }
}
