<?php

declare(strict_types=1);

namespace Authanram\Generators\Pipes;

use Authanram\Generators\Assert;
use Authanram\Generators\Contracts\Passable;
use Authanram\Generators\Contracts\Pipe;
use Authanram\Generators\FileHandler;

final class ResolveTemplatePipe implements Pipe
{
    public static function handle(Passable $passable, callable $next): Passable
    {
        $stub = $passable->stub();

        Assert::stringNotEmpty($stub, Assert::message(Assert::EMPTY, '$stub'));

        $stub = trim(FileHandler::readOrReturn($stub));

        return $next($passable->withStub($stub));
    }
}
