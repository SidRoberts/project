<?php

namespace MyApp\Service;

use Cocur\Slugify\Slugify;
use Sid\Container\Service;

class SlugifyService extends Service
{
    public function getName() : string
    {
        return "slugify";
    }

    public function isShared() : bool
    {
        return true;
    }

    public function resolve()
    {
        $slugify = new Slugify();

        return $slugify;
    }
}
