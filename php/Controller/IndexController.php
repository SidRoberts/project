<?php

namespace MyApp\Controller;

use Sid\Framework\Controller;
use Sid\Framework\Router\Annotations\Route;

use Twig_Environment;

class IndexController extends Controller
{
    /**
     * @var Twig_Environment
     */
    protected $twig;



    public function __construct(Twig_Environment $twig)
    {
        $this->twig = $twig;
    }



    /**
     * @Route(
     *     "/"
     * )
     */
    public function index()
    {
        return $this->twig->render(
            "index/index.twig"
        );
    }
}
