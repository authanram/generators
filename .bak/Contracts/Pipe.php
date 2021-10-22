<?php

declare(strict_types=1);

namespace Authanram\Generators\Contracts;

interface Pipe
{
    public static function handle(Passable $passable, callable $next): Passable;
}
