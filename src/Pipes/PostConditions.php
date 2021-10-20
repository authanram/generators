<?php

declare(strict_types=1);

namespace Authanram\Generators\Pipes;

use Authanram\Generators\Contracts\Passable;
use Authanram\Generators\Contracts\Pipe;
use Illuminate\Support\Str;

class PostConditions implements Pipe
{
    public static function handle(Passable $passable, $next): Passable
    {
        $passable->text = (string)Str::of($passable->text)
            ->replace("\n\n\n", "\n");

        return $next($passable);
    }
}
