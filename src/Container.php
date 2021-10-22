<?php

declare(strict_types=1);

namespace Authanram\Generators;

use Authanram\Generators\Contracts\Services as ServicesContract;
use Illuminate\Container\Container as IlluminateContainer;

class Container extends IlluminateContainer
{
    public function __construct()
    {
        IlluminateContainer::setInstance($this);
    }

    public function services(): ServicesContract
    {
        return new Services();
    }
}
