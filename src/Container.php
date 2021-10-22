<?php

declare(strict_types=1);

namespace Authanram\Generators;

use Authanram\Generators\Contracts\Services as ServicesContract;
use Illuminate\Container\Container as BaseContainer;

class Container extends BaseContainer implements Contracts\Container
{
    public function __construct()
    {
        BaseContainer::setInstance($this);
    }

    public function services(): ServicesContract
    {
        return new Services();
    }
}
