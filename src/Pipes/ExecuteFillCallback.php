<?php

declare(strict_types=1);

namespace Authanram\Generators\Pipes;

use Authanram\Generators\Contracts\Passable;
use Authanram\Generators\Contracts\Pipe;
use Authanram\Generators\Markers;

class ExecuteFillCallback implements Pipe
{
    public static function handle(Passable $passable, callable $next): Passable
    {
        $descriptor = $passable->getDescriptor();

        $descriptor->setMarkers(Markers::make(
            $descriptor::fill($descriptor->getMarkers()),
        ));

        return $next($passable->setDescriptor($descriptor));
    }
}
