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
        $descriptor = $passable->getDescriptor();

        $items = $descriptor->getMarkers()->getItems();

        foreach ($items as $marker => $value) {
            $text = str_replace(
                sprintf($descriptor->getPattern(), $marker),
                static::value($value),
                $descriptor->getText(),
            );

            $descriptor->setText($text);
        }

        return $next($passable->setDescriptor($descriptor));
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
