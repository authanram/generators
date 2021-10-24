<?php

declare(strict_types=1);

namespace Authanram\Generators\Pipes;

use Authanram\Generators\Contracts\Passable;
use Authanram\Generators\Contracts\Pipe;
use Authanram\Generators\Input;

final class FillTemplateVariables implements Pipe
{
    public static function handle(Passable $passable, callable $next): Passable
    {
        $input = new Input($passable->input());

        $templateVariables = ($passable->fillCallback())($input);

        return $next($passable->withInputFilled($templateVariables));
    }
}
