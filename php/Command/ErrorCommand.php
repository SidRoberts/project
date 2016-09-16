<?php

namespace MyApp\Command;

use Sid\Framework\Controller;
use Sid\Framework\Router\Annotations\Route;

use Symfony\Component\Console\Output\ConsoleOutput;

use Symfony\Component\Translation\Translator;

class ErrorCommand extends Controller
{
    /**
     * @var ConsoleOutput
     */
    protected $cliOutput;

    /**
     * @var Translator
     */
    protected $translator;



    public function __construct(ConsoleOutput $cliOutput, Translator $translator)
    {
        $this->cliOutput  = $cliOutput;
        $this->translator = $translator;
    }



    public function error404()
    {
        $this->cliOutput->writeln(
            "<error>" . $this->translator->trans("Error 404 - Not Found") . "</error>"
        );
    }
}
