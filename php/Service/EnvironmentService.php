<?php

namespace MyApp\Service;

use Sid\Container\Service;

class EnvironmentService extends Service
{
    /**
     * @var string
     */
    protected $environment;



    public function __construct(string $environment)
    {
        $this->environment = $environment;
    }



    public function getName() : string
    {
        return "environment";
    }

    public function isShared() : bool
    {
        return true;
    }

    public function resolve()
    {
        return $this->environment;
    }
}
