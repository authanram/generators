<?php

declare(strict_types=1);

namespace Authanram\Generators;

class Passable implements Contracts\Passable
{
    private Descriptor $descriptor;

    public static function make(Descriptor $descriptor): static
    {
        return (new static())->setDescriptor($descriptor);
    }

    public function getDescriptor(): Descriptor
    {
        return $this->descriptor;
    }

    public function setDescriptor(Descriptor $descriptor): static
    {
        $this->descriptor = $descriptor;

        return $this;
    }
}
