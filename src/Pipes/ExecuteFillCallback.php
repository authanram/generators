<?php

declare(strict_types=1);

namespace Authanram\Generators\Pipes;

use Authanram\Generators\Contracts\Passable;
use Authanram\Generators\Contracts\Pipe;
use Authanram\Generators\Markers;

class ExecuteFillCallback implements Pipe
{
    public static function handle(Passable $passable, $next): Passable
    {
        $markers = $passable->descriptor::fill($passable->markers);

        $passable->markers = Markers::make($markers);

        return $next($passable);
    }
}
