<?php

declare(strict_types=1);

namespace Authanram\Generators\Pipes;

use Authanram\Generators\Contracts\Passable;
use Authanram\Generators\Contracts\Pipe;
use Illuminate\Support\Str;

final class Postprocess implements Pipe
{
    public static function handle(Passable $passable, callable $next): Passable
    {
        $template = (string) Str::of($passable->inputPath())
            ->replace("\n\n\n", "\n");

        return $next($passable->withInputPath($template));
    }
}
