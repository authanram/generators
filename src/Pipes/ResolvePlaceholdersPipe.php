<?php

declare(strict_types=1);

namespace Authanram\Generators\Pipes;

use Authanram\Generators\Contracts\Passable;
use Authanram\Generators\Contracts\Pipe;
use Authanram\Generators\PlaceholdersResolver;

final class ResolvePlaceholdersPipe implements Pipe
{
    public static function handle(Passable $passable, callable $next): Passable
    {
        $placeholders = PlaceholdersResolver::resolve(
            $passable->stub(),
            $passable->pattern(),
        );

        $placeholders = array_combine($placeholders, $placeholders);

        return $next($passable->withPlaceholders($placeholders));
    }
}
