<?php

namespace MyApp\Bootstrap;

use MyApp\BootstrapDefinition;

class CliDefinition extends BootstrapDefinition
{
    public function getEnvironment() : string
    {
        return "cli";
    }

    public function getKernel() : string
    {
        return "cliKernel";
    }

    public function getRequest() : string
    {
        return "cliRequest";
    }

    public function handleReturnedValue($exitCode)
    {
        exit($exitCode);
    }
}
