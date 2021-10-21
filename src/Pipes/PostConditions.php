<?php

declare(strict_types=1);

namespace Authanram\Generators\Pipes;

use Authanram\Generators\Contracts\Passable;
use Authanram\Generators\Contracts\Pipe;
use Illuminate\Support\Str;

class PostConditions implements Pipe
{
    public static function handle(Passable $passable, callable $next): Passable
    {
        $descriptor = $passable->getDescriptor();

        $text = (string) Str::of($descriptor->getText())
            ->replace("\n\n\n", "\n");

        return $next($passable->setDescriptor(
            $descriptor->setText($text),
        ));
    }
}
