<?php

declare(strict_types=1);

namespace Authanram\Generators\Contracts;

use Authanram\Generators\Passable;
use Illuminate\Container\Container;

interface Pipeline
{
    /** @param array<Pipe|string> $pipes */
    public static function handle(
        Passable $passable,
        array $pipes,
        Container $container,
    ): Passable;
}
