<?php

declare(strict_types=1);

namespace Authanram\Generators\Contracts;

use Authanram\Generators\Descriptor;

interface Passable
{
    public static function make(Descriptor $descriptor): static;

    public function getDescriptor(): Descriptor;

    public function setDescriptor(Descriptor $descriptor): static;
}
