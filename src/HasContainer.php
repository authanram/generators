<?php

declare(strict_types=1);

namespace Authanram\Generators;

use Illuminate\Container\Container;

trait HasContainer
{
    private Container $__container;

    public function container(): Container
    {
        $this->__container = $this->__container ?? new Container();

        return $this->__container;
    }

    public function withContainer(Container $container): self
    {
        $this->__container = $container;

        return $this;
    }
}
