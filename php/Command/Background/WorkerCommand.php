<?php

namespace MyApp\Command\Background;

use Symfony\Component\Console\Input\ArrayInput;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

final class WorkerCommand extends \MyApp\Console\Command
{
    public function configure()
    {
        $this->setName("background:worker");

        $this->setDescription("Execute the next ready job in the queue");
    }

    public function execute(InputInterface $input, OutputInterface $output)
    {
        $pheanstalk = $this->container->get("pheanstalk");



        $job = $pheanstalk->reserve();

        $body = json_decode(
            $job->getData(),
            true
        );

        try {
            if (!isset($body["command"])) {
                throw new \Exception("No command given");
            }

            $jobInput = new ArrayInput($body);

            $application = $this->getApplication();

            $command = $application->find(
                $body["command"]
            );

            $command->run($jobInput, $output);

            $pheanstalk->delete($job);
        } catch (\Exception $e) {
            $pheanstalk->bury($job);

            throw $e;
        }
    }
}
