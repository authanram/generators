<?php /** @noinspection PhpDocSignatureInspection */

declare(strict_types=1);

namespace Authanram\Generators;

abstract class Descriptor
{
    abstract public static function template(): string;

    /** @return string[] */
    abstract public static function fill(Marker $data): array;
}
