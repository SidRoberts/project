<?php

namespace MyApp\Service;

use Sid\Container\Service;

use Redis;

use Monolog\Logger;
use Monolog\Handler\RedisHandler;

class MonologService extends Service
{
    public function getName() : string
    {
        return "monolog";
    }

    public function isShared() : bool
    {
        return true;
    }

    public function resolve(Redis $redis)
    {
        $monolog = new Logger(
            "monolog"
        );

        $handler = new RedisHandler(
            $redis,
            "logs",
            Logger::WARNING
        );

        $monolog->pushHandler($handler);

        return $monolog;
    }
}
