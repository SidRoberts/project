<?php

chdir(__DIR__);

require '.vendor/autoload.php';



$bootstrapDefintion = new \MyApp\Bootstrap\CliDefinition();

$bootstrap = new \MyApp\Bootstrap($bootstrapDefintion);



$container = $bootstrap->createContainer();

$doctrine = $container->get("doctrine");

return \Doctrine\ORM\Tools\Console\ConsoleRunner::createHelperSet($doctrine);
