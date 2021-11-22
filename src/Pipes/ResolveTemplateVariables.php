<?php

declare(strict_types=1);

namespace Authanram\Generators\Pipes;

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

        $templateVariables = array_combine(
            $templateVariables,
            $templateVariables
        );

        $input = array_merge(
            $templateVariables,
            $passable->input(),
        );

        return $next($passable->withInput($input));
    }
}
