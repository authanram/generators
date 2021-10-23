<?php

declare(strict_types=1);

namespace Authanram\Generators\Pipes;

use Authanram\Generators\Contracts\Passable;
use Authanram\Generators\Contracts\Pipe;
use Illuminate\Support\Str;

final class PostprocessPipe implements Pipe
{
    public static function handle(Passable $passable, callable $next): Passable
    {
        $stub = (string) Str::of($passable->stub())
            ->replace("\n\n\n", "\n");

        return $next($passable->withStub($stub));
    }
}
