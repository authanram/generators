<?php

declare(strict_types=1);

namespace Authanram\Generators\Pipes;

use Authanram\Generators\Contracts\Passable;
use Authanram\Generators\Contracts\Pipe;
use Illuminate\Support\Collection;

final class ReplacePlaceholdersPipe implements Pipe
{
    public static function handle(Passable $passable, callable $next): Passable
    {
        $descriptor = $passable->descriptor();

        foreach ($passable->placeholders() as $placeholder => $value) {
            $output = str_replace(
                sprintf($descriptor::pattern(), $placeholder),
                self::value($value),
                $passable->output(),
            );

            $passable->withOutput($output);
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
