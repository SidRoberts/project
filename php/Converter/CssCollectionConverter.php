<?php

namespace MyApp\Converter;

use Sid\Framework\ConverterInterface;
use Sid\Framework\Router\Exception\RouteNotFoundException;

use Symfony\Component\HttpFoundation\Response;

use Zend\Config\Config;

class CssCollectionConverter implements ConverterInterface
{
    /**
     * @var Config
     */
    protected $config;



    public function __construct(Config $config)
    {
        $this->config = $config;
    }



    public function convert(string $name)
    {
        $collections = $this->config->assets->css->collections;



        if (!isset($collections[$name])) {
            throw new RouteNotFoundException();
        }



        return $collections[$name];
    }
}
