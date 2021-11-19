<?php /** @noinspection PhpDocSignatureIsNotCompleteInspection */

declare(strict_types=1);

namespace Authanram\Generators;

use Illuminate\Support\Stringable;

abstract class Descriptor
{
    public const PATTERN = '{{ %s }}';

    abstract public static function path(): string;

    /** @return array<string, Stringable|string> */
    abstract public static function fill(Input $input): array;

    public static function pattern(): string
    {
        return self::PATTERN;
    }
}
