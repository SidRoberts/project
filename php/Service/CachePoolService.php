<?php

namespace MyApp\Service;

use Sid\Container\Service;
use Sid\Container\Container;
use Doctrine\Common\Cache\Cache;
use Sid\CachePool\Pool;

class CachePoolService extends Service
{
    public function getName() : string
    {
        return "cachePool";
    }

    public function isShared() : bool
    {
        return true;
    }

    public function resolve(Container $container, Cache $cache)
    {
        $cachePool = new Pool($container, $cache);

        return $cachePool;
    }
}
