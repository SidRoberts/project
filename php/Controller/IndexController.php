<?php

namespace MyApp\Controller;

use Sid\Framework\Controller;
use Sid\Framework\Router\Route\Uri;

final class IndexController extends Controller
{
    /**
     * @Uri("/")
     */
    public function index(\Twig\Environment $twig)
    {
        return $twig->render(
            "index/index.twig"
        );
    }
}
