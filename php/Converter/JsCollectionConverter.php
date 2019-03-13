<?php

namespace MyApp\Converter;

use Sid\Framework\ConverterInterface;
use Sid\Framework\Router\Exception\RouteNotFoundException;

use Zend\Config\Config;

class JsCollectionConverter implements ConverterInterface
{
    /**
     * @var Config
     */
    protected $config;



    public function __construct(Config $config)
    {
        $this->config = $config;
    }



    public function convert(string $name) : array
    {
        $collections = $this->config->assets->js->collections;



        if (!isset($collections[$name])) {
            throw new RouteNotFoundException();
        }



        $collection = $collections[$name]->toArray();



        return $collection;
    }
}
