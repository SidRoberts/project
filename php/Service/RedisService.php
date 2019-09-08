<?php

namespace MyApp\Service;

use Redis;
use Sid\Container\Service;
use Zend\Config\Config;

class RedisService extends Service
{
    public function getName() : string
    {
        return "redis";
    }

    public function isShared() : bool
    {
        return true;
    }

    public function resolve(Config $config)
    {
        $redis = new Redis();

        $redis->connect(
            $config->redis->host,
            $config->redis->port
        );

        return $redis;
    }
}
