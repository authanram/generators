<?php

declare(strict_types=1);

namespace Authanram\Generators\Pipes;

use Authanram\Generators\Contracts\Passable;
use Authanram\Generators\Contracts\Pipe;
use Authanram\Generators\Data;

final class ExecuteFillCallbackPipe implements Pipe
{
    public static function handle(Passable $passable, callable $next): Passable
    {
        $descriptor = $passable->descriptor();

        $data = new Data($passable->input());

        $placeholders = $descriptor::fill($data);

        return $next($passable->withPlaceholders($placeholders));
    }
}
