<?php

declare(strict_types=1);

namespace Authanram\Generators\Pipes;

use Authanram\Generators\Contracts\Passable;
use Authanram\Generators\Contracts\Pipe;
use Authanram\Generators\Exceptions\InvalidArgument;
use Authanram\Generators\Exceptions\InvalidPatternPhrase;
use Authanram\Generators\Markers;
use Authanram\Generators\MarkersResolver;

final class ResolveMarkers implements Pipe
{
    /**
     * @throws InvalidArgument
     * @throws InvalidPatternPhrase
     */
    public static function handle(Passable $passable, callable $next): Passable
    {
        $markers = MarkersResolver::resolve($passable->descriptor()->text());

        $markers = array_combine($markers, $markers);

        $passable->descriptor()->withMarkersResolved(Markers::make($markers));

        return $next($passable);
    }
}
