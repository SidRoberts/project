<?php

namespace MyApp\Command\Background;

use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

final class RaiseCommand extends \MyApp\Console\Command
{
    public function configure()
    {
        $this->setName("background:raise");

        $this->setDescription(
            "Execute the oldest buried (failed) job in the queue"
        );
    }

    public function execute(InputInterface $input, OutputInterface $output)
    {
        $pheanstalk = $this->container->get("pheanstalk");



        //FIXME This doesn't reserve the job.
        $job = $pheanstalk->peekBuried();

        if (!$job) {
            throw new \Exception("No job.");
        }

        $body = json_decode(
            $job->getData(),
            true
        );

        if (!isset($body["command"])) {
            throw new \Exception("No command given");
        }

        $jobInput = new ArrayInput($body);

        $application = $this->getApplication();

        $command = $application->find(
            $body["command"]
        );

        try {
            $command->run($jobInput, $output);

            $pheanstalk->delete($job);
        } catch (\Exception $e) {
            $pheanstalk->bury($job);

            throw $e;
        }
    }
}
