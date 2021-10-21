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
        $text = (string)Str::of($passable->getText())
            ->replace("\n\n\n", "\n");

        $passable->setText($text);

        return $next($passable);
    }
}
