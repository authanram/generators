<?php

declare(strict_types=1);

namespace Authanram\Generators\Pipes;

use Authanram\Generators\Pipe;
use Authanram\Generators\Markers;
use Authanram\Generators\Passable;

class ExecuteFillCallback implements Pipe
{
    public static function handle(Passable $passable, $next): Passable
    {
        $markers = $passable->descriptor::fill($passable->markers);

        $passable->markers = Markers::make($markers);

        return $next($passable);
    }
}
