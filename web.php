<?php

chdir(__DIR__);

require ".vendor/autoload.php";



use MyApp\Bootstrap;

use Whoops\Handler\PrettyPageHandler;



$whoops = new \Whoops\Run;

$whoops->pushHandler(
    new PrettyPageHandler()
);

$whoops->register();



$bootstrap = new Bootstrap();

$bootstrap->web();
