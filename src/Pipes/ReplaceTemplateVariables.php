<?php

declare(strict_types=1);

namespace Authanram\Generators\Pipes;

use Authanram\Generators\Contracts\Passable;
use Authanram\Generators\Contracts\Pipe;
use Illuminate\Support\Collection;

final class ReplaceTemplateVariables implements Pipe
{
    public static function handle(Passable $passable, callable $next): Passable
    {
        foreach ($passable->input() as $templateVariable => $value) {
            $template = str_replace(
                sprintf($passable->pattern(), $templateVariable),
                self::value($value),
                $passable->template(),
            );

            $passable->withTemplate($template);
        }

        return $next($passable);
    }

    private static function value(array|string $subject): string
    {
        $fn = static fn ($item) => is_callable($item)
            ? $item($item)
            : $item;

        return self::toCollection($subject)->map($fn)->implode("\n");
    }

    private static function toCollection(array|string $subject): Collection
    {
        return collect(is_array($subject) ? $subject : [$subject]);
    }
}
