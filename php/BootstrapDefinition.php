<?php

namespace MyApp;

abstract class BootstrapDefinition
{
    abstract public function getEnvironment() : string;
}
