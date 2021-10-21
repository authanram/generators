<?php

declare(strict_types=1);

namespace Authanram\Generators\Pipes;

use Authanram\Generators\Contracts\Passable;
use Authanram\Generators\Contracts\Pipe;
use Illuminate\Support\Collection;

class ReplaceMarkers implements Pipe
{
    public static function handle(Passable $passable, $next): Passable
    {
        foreach ($passable->getMarkers()->getItems() as $marker => $value) {
            $passable->setText(
                str_replace(
                    sprintf($passable->getPattern(), $marker),
                    static::value($value),
                    $passable->getText(),
                ),
            );
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
