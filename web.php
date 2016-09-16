<?php

chdir(__DIR__);

require ".vendor/autoload.php";



$whoops = new \Whoops\Run;

$whoops->pushHandler(
    new \Whoops\Handler\PrettyPageHandler()
);

$whoops->register();



$bootstrapDefintion = new \MyApp\Bootstrap\WebDefinition();

$bootstrap = new \MyApp\Bootstrap($bootstrapDefintion);

$bootstrap->boot();
