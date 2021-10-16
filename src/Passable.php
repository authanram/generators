<?php

declare(strict_types=1);

namespace Authanram\JetstreamPlugin\Generators;

use Authanram\Generators\Contracts\Descriptor;

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
