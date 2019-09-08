<?php

namespace MyApp\Service;

use Monolog\Handler\RedisHandler;
use Monolog\Logger;
use Redis;
use Sid\Container\Service;

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
