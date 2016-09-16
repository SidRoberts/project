<?php

namespace MyApp\Service;

use Sid\Container\Service;

class FlysystemService extends Service
{
    public function getName() : string
    {
        return "flysystem";
    }

    public function isShared() : bool
    {
        return true;
    }

    public function resolve()
    {
        $adapter = new \League\Flysystem\Adapter\Local(
            ""
        );

        $filesystem = new \League\Flysystem\Filesystem($adapter);

        return $flysystem;
    }
}
