#!/usr/bin/env php
<?php

chdir(__DIR__);

require ".vendor/autoload.php";



$whoops = new \Whoops\Run;

$whoops->pushHandler(
    new \Whoops\Handler\PlainTextHandler()
);

$whoops->register();



$bootstrap = new \MyApp\Bootstrap();

$bootstrap->cli();
