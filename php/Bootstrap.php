<?php

namespace MyApp;

use MyApp\Service\EnvironmentService;

use Sid\Container\Container;

class Bootstrap
{
    protected $definition;



    public function __construct(BootstrapDefinition $definition)
    {
        $this->definition = $definition;
    }



    public function createContainer() : Container
    {
        $container = ContainerBuilder::build();

        $container->add(
            new EnvironmentService(
                $this->definition->getEnvironment()
            )
        );

        return $container;
    }



    public function boot()
    {
        $container = $this->createContainer();

        $this->definition->boot($container);
    }
}