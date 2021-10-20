<?php

declare(strict_types=1);

namespace Authanram\Generators\Pipes;

use Authanram\Generators\Contracts\Passable;
use Authanram\Generators\Contracts\Pipe;
use Authanram\Generators\MarkersResolver;

class ResolveMarkers implements Pipe
{
    public static function handle(Passable $passable, $next): Passable
    {
//        $passable->markers = MarkerResolver::resolve($passable->text);

        return $next($passable);
    }
}
