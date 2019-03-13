<?php

namespace MyApp\Controller;

use JShrink\Minifier;

use Sid\Framework\Controller;
use Sid\Framework\Parameters;
use Sid\Framework\Router\Exception\RouteNotFoundException;
use Sid\Framework\Router\Route\Converters;
use Sid\Framework\Router\Route\Requirements;
use Sid\Framework\Router\Route\Uri;

use Symfony\Component\HttpFoundation\Response;

use Zend\Config\Config;

class JsController extends Controller
{
    /**
     * @Uri("/js/{collection}")
     *
     * @Requirements(
     *     collection="[a-z0-9\-]+"
     * )
     *
     * @Converters(
     *     collection="MyApp\Converter\JsCollectionConverter"
     * )
     */
    public function js(Parameters $parameters, Config $config)
    {
        $collection = $parameters->get("collection");



        $content = "";

        foreach ($collection as $asset) {
            $content .= file_get_contents($asset);
        }



        $content = Minifier::minify($content);



        return new Response(
            $content,
            Response::HTTP_OK,
            [
                "Content-Type" => "application/javascript",
            ]
        );
    }
}
