<?php

declare(strict_types=1);

namespace Authanram\Generators;

/** @todo generate from directory contents */
class Mutators
{
    public static function php(string $placeholder): Mutators\Php
    {
        return new Mutators\Php($placeholder);
    }

    public static function string(string $placeholder): Mutators\Stringable
    {
        return new Mutators\Stringable($placeholder);
    }
}
