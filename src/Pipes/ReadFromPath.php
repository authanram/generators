<?php

declare(strict_types=1);

namespace Authanram\Generators\Pipes;

use Authanram\Generators\Contracts\Passable;
use Authanram\Generators\Contracts\Pipe;

class ReadFromPath implements Pipe
{
    public static function handle(Passable $passable, $next): Passable
    {
//        dd($passable);

        return $next($passable);
    }
}
