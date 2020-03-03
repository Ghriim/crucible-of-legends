<?php

namespace App\Domain\Exception;

class LazyLoadException extends \RuntimeException
{
    public function __construct(string $lazyLoadedClass)
    {
        parent::__construct("LazyLoad has been triggered. $lazyLoadedClass is lazy loaded.");
    }
}