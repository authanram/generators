<?php

declare(strict_types=1);

namespace Authanram\Generators\Pipes;

use Authanram\Generators\Contracts\Passable;
use Authanram\Generators\Contracts\Pipe;

final class ResolveMarkers implements Pipe
{
    public static function handle(Passable $passable, callable $next): Passable
    {
//        $markers = MarkersResolver::resolve($passable->descriptor()->text());
//
//        $markers = array_combine($markers, $markers);
//
//        $passable->descriptor()->withMarkersResolved(Markers::make($markers));

        return $next($passable);
    }
}
