<?php

chdir(__DIR__);

require ".vendor/autoload.php";



$whoops = new \Whoops\Run;

$whoops->pushHandler(
    new \Whoops\Handler\PrettyPageHandler()
);

$whoops->register();



$bootstrap = new \MyApp\Bootstrap();

$bootstrap->web();
