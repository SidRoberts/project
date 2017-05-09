<?php
 
namespace MyApp\Console;

use Symfony\Component\Console\Command\Command;

use Sid\Container\Container;

class ContainerAwareCommand extends Command
{
    /**
     * @var Container|null
     */
    private $container;



    /**
     * @return Container
     *
     * @throws \LogicException
     */
    protected function getContainer()
    {
        if ($this->container === null) {
            throw new \LogicException(
                "The container cannot be retrieved as the application instance is not yet set."
            );
        }

        return $this->container;
    }

    public function setContainer(Container $container = null)
    {
        $this->container = $container;
    }
}
