<?php

namespace MyApp\Service;

use Redis;
use Sid\Container\Service;

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

    public function resolve()
    {
        $redis = new Redis();

        $redis->connect(
            getenv("REDIS_HOST"),
            getenv("REDIS_PORT")
        );

        return $redis;
    }
}
