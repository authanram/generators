<?php

declare(strict_types=1);

namespace Authanram\Generators;

use Authanram\Generators\Contracts\Passable as Contract;

final class Passable implements Contract
{
    private Descriptor $descriptor;

    public static function make(Descriptor $descriptor): Contract
    {
        return (new self())->withDescriptor($descriptor);
    }

    public function descriptor(): Descriptor
    {
        return $this->descriptor;
    }

    public function withDescriptor(Descriptor $descriptor): Contract
    {
        $this->descriptor = $descriptor;

        return $this;
    }
}
