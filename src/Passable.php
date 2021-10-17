<?php

declare(strict_types=1);

namespace Authanram\Generators;

class Passable
{
    public function __construct(private Descriptor $descriptor) {}

    public static function create(Descriptor $descriptor): static
    {
        return new static($descriptor);
    }

    public function describe(): Descriptor
    {
        return $this->descriptor;
    }
}
