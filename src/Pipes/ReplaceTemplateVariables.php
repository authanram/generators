<?php

declare(strict_types=1);

namespace Authanram\Generators\Pipes;

use Authanram\Generators\Contracts\Passable;
use Authanram\Generators\Contracts\Pipe;
use Illuminate\Support\Collection;
use Illuminate\Support\Stringable;

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

            $passable->useTemplate($template);
        }

        return $next($passable);
    }

    private static function value(Stringable|array|string $subject): string
    {
        return self::toCollection($subject)
            ->map(static fn ($item) => $item)
            ->implode("\n");
    }

    private static function toCollection(
        Stringable|array|string $subject,
    ): Collection {
        return collect(is_array($subject) ? $subject : [$subject]);
    }
}
