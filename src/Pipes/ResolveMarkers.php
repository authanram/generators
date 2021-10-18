<?php

declare(strict_types=1);

namespace Authanram\Generators\Pipes;

use Authanram\Generators\Contracts\Pipe;
use Authanram\Generators\MarkerResolver;
use Authanram\Generators\Passable;

class ResolveMarkers implements Pipe
{
    public static function handle(Passable $passable, $next): Passable
    {
//        $passable->markers = MarkerResolver::resolve($passable->text);

        return $next($passable);
    }
}
