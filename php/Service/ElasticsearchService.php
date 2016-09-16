<?php

namespace MyApp\Service;

use Sid\Container\Service;

use Zend\Config\Config;

class ElasticsearchService extends Service
{
    public function getName() : string
    {
        return "elasticsearch";
    }

    public function isShared() : bool
    {
        return true;
    }

    public function resolve(Config $config)
    {
        $elasticsearch = new \Elasticsearch\Client(
            [
                "hosts" => [
                    $config->elasticsearch->host . ":" . $config->elasticsearch->port,
                ],
            ]
        );

        return $elasticsearch;
    }
}
