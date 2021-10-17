<?php /** @noinspection PhpDocSignatureInspection */

declare(strict_types=1);

namespace Authanram\Generators;

abstract class Descriptor
{
    abstract public static function stub(): string;

    /** @return string[] */
    abstract public static function fill(array $input): array;
}
