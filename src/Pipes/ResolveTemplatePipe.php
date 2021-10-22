<?php

declare(strict_types=1);

namespace Authanram\Generators\Pipes;

use Authanram\Generators\Assert;
use Authanram\Generators\Contracts\Passable;
use Authanram\Generators\Contracts\Pipe;

final class ResolveTemplatePipe implements Pipe
{
    public static function handle(Passable $passable, callable $next): Passable
    {
        $template = $passable->descriptor()::template();

        Assert::stringNotEmpty($template, '$template must not be empty.');

        $template = app()->services()->fileReader()->readOrReturn($template);

        return $next($passable->withOutput($template));
    }
}
