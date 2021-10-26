<?php

declare(strict_types=1);

namespace Authanram\Generators\Pipes;

use Authanram\Generators\Contracts\Passable;
use Authanram\Generators\Contracts\Pipe;
use Authanram\Generators\FileHandler;

final class WriteToOutputPath implements Pipe
{
    public static function handle(Passable $passable, callable $next): Passable
    {
        $outputPath = $passable->outputPath();

        FileHandler::write($outputPath, $passable->template());

        return $next($passable);
    }
}
