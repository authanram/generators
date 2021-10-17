<?php

declare(strict_types=1);

namespace Authanram\Generators;

class Passable
{
    public function __construct(private Descriptor $description) {}

    public static function create(Descriptor $description): static
    {
        return new static($description);
    }

    public function describe(): Descriptor
    {
        return $this->description;
    }
}
