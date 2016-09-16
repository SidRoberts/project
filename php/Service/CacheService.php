<?php

namespace MyApp\Service;

use Sid\Container\Service;

use Doctrine\Common\Cache\RedisCache;

use Redis;

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
