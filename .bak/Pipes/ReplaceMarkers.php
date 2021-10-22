<?php

declare(strict_types=1);

namespace Authanram\Generators\Pipes;

use Authanram\Generators\Contracts\Passable;
use Authanram\Generators\Contracts\Pipe;
use Authanram\Generators\Exceptions\InvalidArgument;
use Authanram\Generators\Exceptions\InvalidPatternPhrase;
use Illuminate\Support\Collection;

final class ReplaceMarkers implements Pipe
{
    /**
     * @throws InvalidArgument
     * @throws InvalidPatternPhrase
     */
    public static function handle(Passable $passable, callable $next): Passable
    {
        $descriptor = $passable->descriptor();

        $items = $descriptor->markers()->items();

        foreach ($items as $marker => $value) {
            $text = str_replace(
                sprintf($descriptor->pattern()->phrase(), $marker),
                self::value($value),
                $descriptor->text(),
            );

            $descriptor->withText($text);
        }

        return $next($passable->withDescriptor($descriptor));
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