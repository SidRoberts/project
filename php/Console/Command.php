<?php

namespace MyApp\Console;

use Sid\Container\Container;
use Symfony\Component\Console\Command\Command as SymfonyCommand;

class Command extends SymfonyCommand
{
    /**
     * @var Container
     */
    protected $container;



    final public function __construct(Container $container)
    {
        $this->container = $container;

        parent::__construct();
    }
}
