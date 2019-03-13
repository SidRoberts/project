<?php

namespace MyApp\Controller;

use Less_Cache;

use Sid\Framework\Controller;
use Sid\Framework\Parameters;
use Sid\Framework\Router\Exception\RouteNotFoundException;
use Sid\Framework\Router\Route\Converters;
use Sid\Framework\Router\Route\Requirements;
use Sid\Framework\Router\Route\Uri;

use Symfony\Component\HttpFoundation\Response;

use Zend\Config\Config;

class CssController extends Controller
{
    /**
     * @Uri("/css/{collection}")
     *
     * @Requirements(
     *     collection="[a-z0-9\-]+"
     * )
     *
     * @Converters(
     *    collection="MyApp\Converter\CssCollectionConverter"
     * )
     */
    public function css(Parameters $parameters, Config $config)
    {
        $filename = $parameters->get("collection");



        $cssFileName = Less_Cache::Get(
            [
                $filename => $config->url->baseUri,
            ],
            [
                "cache_dir" => $config->assets->css->cacheDir,
            ]
        );

        $content = file_get_contents(
            $config->assets->css->cacheDir . "/" . $cssFileName
        );



        return new Response(
            $content,
            Response::HTTP_OK,
            [
                "Content-Type" => "text/css",
            ]
        );
    }
}
