<?php

namespace MyApp\Bootstrap;

use MyApp\BootstrapDefinition;

class WebDefinition extends BootstrapDefinition
{
    public function getEnvironment() : string
    {
        return "web";
    }

    public function getKernel() : string
    {
        return "httpKernel";
    }

    public function getRequest() : string
    {
        return "request";
    }

    public function handleReturnedValue($response)
    {
        $response->send();
    }
}
