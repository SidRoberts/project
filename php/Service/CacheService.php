<?php

namespace MyApp\Service;

use Doctrine\Common\Cache\RedisCache;
use Redis;
use Sid\Container\Service;

class CacheService extends Service
{
    public function getName() : string
    {
        return "cache";
    }

    public function isShared() : bool
    {
        return true;
    }

    public function resolve(Redis $redis)
    {
        $cache = new RedisCache();

        $cache->setRedis($redis);

        return $cache;
    }
}
