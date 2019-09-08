<?php

namespace MyApp\Controller;

use Sid\Framework\Controller;
use Sid\Framework\Router\Route\Uri;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class ErrorController extends Controller
{
    /**
     * @Uri("/error/403")
     */
    public function error403(\Twig\Environment $twig, Request $request)
    {
        return new Response(
            $twig->render(
                "error/403.twig",
                [
                    "uri" => $request->getRequestUri(),
                ]
            ),
            Response::HTTP_FORBIDDEN
        );
    }

    /**
     * @Uri("/error/404")
     */
    public function error404(\Twig\Environment $twig, Request $request)
    {
        return new Response(
            $twig->render(
                "error/404.twig",
                [
                    "uri" => $request->getRequestUri(),
                ]
            ),
            Response::HTTP_NOT_FOUND
        );
    }

    /**
     * @Uri("/error/500")
     */
    public function error500(\Twig\Environment $twig, Request $request)
    {
        return new Response(
            $twig->render(
                "error/500.twig",
                [
                    "uri" => $request->getRequestUri(),
                ]
            ),
            Response::HTTP_INTERNAL_SERVER_ERROR
        );
    }
}
