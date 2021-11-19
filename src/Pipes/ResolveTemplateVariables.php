<?php

declare(strict_types=1);

namespace Authanram\Generators\Pipes;

use Authanram\Generators\Assert;
use Authanram\Generators\Contracts\Passable;
use Authanram\Generators\Contracts\Pipe;
use Authanram\Generators\TemplateVariablesResolver;

final class ResolveTemplateVariables implements Pipe
{
    public static function handle(Passable $passable, callable $next): Passable
    {
        $templateVariables = TemplateVariablesResolver::resolve(
            $passable->template(),
            $passable->pattern(),
        );

        Assert::diffInput(array_unique(array_diff(
            $templateVariables,
            array_keys($passable->input()),
        )));

        $templateVariables = array_combine(
            $templateVariables,
            $passable->input(),
        );

        return $next($passable->withInput($templateVariables));
    }
}
