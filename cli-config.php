<?php

chdir(__DIR__);

require '.vendor/autoload.php';



$bootstrap = new \MyApp\Bootstrap();



$container = $bootstrap->createContainer();

$doctrine = $container->get("doctrine");

return \Doctrine\ORM\Tools\Console\ConsoleRunner::createHelperSet($doctrine);
