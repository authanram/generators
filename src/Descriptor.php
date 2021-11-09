<?php /** @noinspection PhpDocSignatureIsNotCompleteInspection */

declare(strict_types=1);

namespace Authanram\Generators;

abstract class Descriptor
{
    public const PATTERN = '{{ %s }}';

    abstract public static function path(): string;

    /** @return array<string> */
    abstract public static function fill(Input $data): array;

    public static function pattern(): string
    {
        return self::PATTERN;
    }
}
