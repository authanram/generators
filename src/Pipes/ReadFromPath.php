<?php

declare(strict_types=1);

namespace Authanram\Generators\Pipes;

use Authanram\Generators\Passable;
use Authanram\Generators\Pipe;

class ReadFromPath implements Pipe
{
    public static function handle(Passable $passable, $next): Passable
    {
        return $next($passable);
    }
}
