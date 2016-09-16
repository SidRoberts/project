<?php

namespace MyApp;

abstract class BootstrapDefinition
{
    abstract public function getEnvironment() : string;

    abstract public function getKernel() : string;

    abstract public function getRequest() : string;

    abstract public function handleReturnedValue($returnedValue);
}
