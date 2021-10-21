<?php

declare(strict_types=1);

namespace Authanram\Generators;

class Helpers
{
    public static function pipe(mixed $value, callable $callback): mixed
    {
        return $callback($value);
    }

    public static function rayReturn(mixed $value): mixed
    {
        ray($value);

        return $value;
    }
}
