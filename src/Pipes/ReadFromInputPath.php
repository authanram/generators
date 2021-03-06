<?php

declare(strict_types=1);

namespace Authanram\Generators\Pipes;

use Authanram\Generators\Assert;
use Authanram\Generators\Contracts\Passable;
use Authanram\Generators\Contracts\Pipe;
use Authanram\Generators\FileHandler;

final class ReadFromInputPath implements Pipe
{
    public static function handle(Passable $passable, callable $next): Passable
    {
        $inputPath = $passable->inputPath();

        Assert::stringNotEmpty(
            $inputPath,
            Assert::message(Assert::NOT_EMPTY, '$inputPath'),
        );

        $template = trim(FileHandler::read($inputPath));

        Assert::stringNotEmpty(
            $template,
            Assert::message(Assert::NOT_EMPTY, '$template'),
        );

        return $next($passable->withTemplate($template));
    }
}
