<?php

declare(strict_types=1);

namespace Authanram\Generators\Pipes;

use Authanram\Generators\Contracts\Passable;
use Authanram\Generators\Contracts\Pipe;
use Illuminate\Support\Collection;

class ReplaceMarkers implements Pipe
{
    public static function handle(Passable $passable, callable $next): Passable
    {
        $descriptor = $passable->descriptor();

        $items = $descriptor->markers()->items();

        foreach ($items as $marker => $value) {
            $text = str_replace(
                sprintf($descriptor->pattern()->phrase(), $marker),
                static::value($value),
                $descriptor->text(),
            );

            $descriptor->withText($text);
        }

        return $next($passable->withDescriptor($descriptor));
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
