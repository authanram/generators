<?php /** @noinspection PhpDocSignatureInspection */

declare(strict_types=1);

namespace Authanram\Generators;

abstract class Descriptor
{
    /** @return string[] */
    abstract public static function fill(Markers $markers): array;
}
