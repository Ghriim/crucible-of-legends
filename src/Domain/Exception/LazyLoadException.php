<?php

namespace App\Domain\Exception;

class LazyLoadException extends \RuntimeException
{
    public function __construct(string $parentClass, string $lazyLoadedClass)
    {
        parent::__construct("LazyLoad has been triggered. $parentClass is lazy loading $lazyLoadedClass");
    }
}