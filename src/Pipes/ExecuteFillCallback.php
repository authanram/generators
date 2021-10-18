<?php

declare(strict_types=1);

namespace Authanram\Generators\Pipes;

use Authanram\Generators\Contracts\Pipe;
use Authanram\Generators\Passable;
use Illuminate\Support\Collection;

class ExecuteFillCallback implements Pipe
{
    public static function handle(Passable $passable, $next): Passable
    {
        return $next($passable);
    }

    private static function replace(array|string $subject): string
    {
        return static::toCollection($subject)
            ->map(fn (string $item) => $item)
            ->implode("\n");
    }

    private static function toCollection(array|string $subject): Collection
    {
        return collect(is_array($subject) ? $subject : [$subject]);
    }
}
