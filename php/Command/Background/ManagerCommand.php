<?php

namespace MyApp\Command\Background;

use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class ManagerCommand extends \MyApp\Console\Command
{
    public function configure()
    {
        $this->setName("background:manager");
    }

    public function execute(InputInterface $input, OutputInterface $output)
    {
        while (true) {
            $output->write(
                shell_exec("php cli.php background:worker")
            );
        }
    }
}
