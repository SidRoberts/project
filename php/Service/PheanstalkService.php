<?php

namespace MyApp\Service;

use Pheanstalk\Pheanstalk;

use Sid\Container\Service;

use Zend\Config\Config;

class PheanstalkService extends Service
{
    public function getName() : string
    {
        return "pheanstalk";
    }

    public function isShared() : bool
    {
        return true;
    }

    public function resolve(Config $config)
    {
        $pheanstalk = new Pheanstalk(
            $config->pheanstalk->host,
            $config->pheanstalk->port
        );

        return $pheanstalk;
    }
}
