<?php

namespace MyApp\Controller;

use Sid\Framework\Controller;
use Sid\Framework\Router\Annotations\Route;

use Twig_Environment;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class ErrorController extends Controller
{
    /**
     * @var Twig_Environment
     */
    protected $twig;

    /**
     * @var Request
     */
    protected $request;



    public function __construct(Twig_Environment $twig, Request $request)
    {
        $this->twig    = $twig;
        $this->request = $request;
    }



    public function error403()
    {
        return new Response(
            $this->twig->render(
                "error/403.twig",
                [
                    "uri" => $this->request->getRequestUri(),
                ]
            ),
            Response::HTTP_FORBIDDEN
        );
    }

    public function error404()
    {
        return new Response(
            $this->twig->render(
                "error/404.twig",
                [
                    "uri" => $this->request->getRequestUri(),
                ]
            ),
            Response::HTTP_NOT_FOUND
        );
    }

    /**
     * @Route(
     *     "/error/500"
     * )
     */
    public function error500()
    {
        return new Response(
            $this->twig->render(
                "error/500.twig",
                [
                    "uri" => $this->request->getRequestUri(),
                ]
            ),
            Response::HTTP_INTERNAL_SERVER_ERROR
        );
    }
}
