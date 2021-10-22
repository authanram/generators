<?php

declare(strict_types=1);

namespace Authanram\Generators;

use Illuminate\Support\Collection;

abstract class Descriptor
{
    abstract public static function template(): string;

    /** @return array<string> */
    abstract public static function fill(Collection $data): array;

    public static function pattern(): string
    {
        return '{{ %s }}';
    }

    /** @return array<callable> */
    public static function pipes(): array
    {
        return [];
    }
}
