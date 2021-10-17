<?php

declare(strict_types=1);

namespace Authanram\Generators\Mutators;

/** @todo generate from directory contents */
class Mutators
{
    public const PHP = Php::class;

    public static function php(): Php|string
    {
        return Php::class;
    }

    public static function string(): Stringable|string
    {
        return Stringable::class;
    }
}
