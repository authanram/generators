<?php

declare(strict_types=1);

namespace Authanram\Generators\Pipes;

use Authanram\Generators\Contracts\Passable;
use Authanram\Generators\Contracts\Pipe;

final class PreprocessPipe implements Pipe
{
    public static function handle(Passable $passable, callable $next): Passable
    {
        return $next($passable);
    }
}
