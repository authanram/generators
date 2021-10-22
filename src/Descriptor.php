<?php

declare(strict_types=1);

namespace Authanram\Generators;

abstract class Descriptor
{
    public static function template(): string
    {
        return '';
    }

    public static function pattern(): string
    {
        return '';
    }

    public static function filename(): string
    {
        return '';
    }

    /** @return array<callable> */
    public static function pipes(): array
    {
        return [];
    }

    /** @return array<string> */
    public static function fill(): array
    {
        return [];
    }
}
