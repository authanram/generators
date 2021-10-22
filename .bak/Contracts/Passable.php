<?php

declare(strict_types=1);

namespace Authanram\Generators\Contracts;

use Authanram\Generators\Descriptor;

interface Passable
{
    public static function make(Descriptor $descriptor): Passable;

    public function descriptor(): Descriptor;

    public function withDescriptor(Descriptor $descriptor): Passable;
}
