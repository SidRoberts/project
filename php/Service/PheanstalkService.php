<?php

namespace MyApp\Service;

use Pheanstalk\Pheanstalk;
use Sid\Container\Service;

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

    public function resolve()
    {
        $pheanstalk = Pheanstalk::create(
            getenv("PHEANSTALK_HOST"),
            (int) getenv("PHEANSTALK_PORT")
        );

        return $pheanstalk;
    }
}
