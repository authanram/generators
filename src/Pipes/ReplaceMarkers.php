<?php

declare(strict_types=1);

namespace Authanram\Generators\Pipes;

use Authanram\Generators\Pipe;
use Authanram\Generators\Passable;
use Illuminate\Support\Collection;

class ReplaceMarkers implements Pipe
{
    public static function handle(Passable $passable, $next): Passable
    {
        foreach ($passable->markers as $marker => $value) {
            $marker = sprintf($passable->pattern, $marker);
            $value = static::value($value);
            $passable->text = str_replace($marker, $value, $passable->text);
        }

        return $next($passable);
    }

    private static function value(array|string $subject): string
    {
        return static::toCollection($subject)
            ->map(fn (string $item) => is_callable($item) ? $item($item) : $item)
            ->implode("\n");
    }

    private static function toCollection(array|string $subject): Collection
    {
        return collect(is_array($subject) ? $subject : [$subject]);
    }
}
