#!/usr/bin/env php
<?php

chdir(__DIR__);

require ".vendor/autoload.php";



use MyApp\Bootstrap;
use Whoops\Handler\PlainTextHandler;



$whoops = new \Whoops\Run;

$whoops->pushHandler(
    new PlainTextHandler()
);

$whoops->register();



$bootstrap = new Bootstrap();

$bootstrap->cli();
