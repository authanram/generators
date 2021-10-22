<?php

declare(strict_types=1);

namespace Authanram\Generators\Pipes;

use Authanram\Generators\Contracts\Passable;
use Authanram\Generators\Contracts\Pipe;

final class ExecuteFillCallbackPipe implements Pipe
{
    public static function handle(Passable $passable, callable $next): Passable
    {
//        $descriptor = $passable->descriptor();
//
//        $descriptor->withMarkers(Markers::make(
//            $descriptor::fill($descriptor->markers()),
//        ));
//
//        return $next($passable->withDescriptor($descriptor));

        return $next($passable);
    }
}
