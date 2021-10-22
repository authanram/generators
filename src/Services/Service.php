<?php

declare(strict_types=1);

namespace Authanram\Generators\Services;

use Authanram\Generators\Contracts\Passable;

abstract class Service
{
    private Passable $passable;

    public function withPassable(Passable $passable): self
    {
        $this->passable = $passable;

        return $this;
    }

    public function passable(): Passable
    {
        return $this->passable;
    }
}
