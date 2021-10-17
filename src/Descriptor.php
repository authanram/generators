<?php /** @noinspection PhpDocSignatureInspection */

declare(strict_types=1);

namespace Authanram\Generators;

use Authanram\Generators\Mutators;

abstract class Descriptor
{
    public const TYPE = TYPE::class;

    abstract public static function stub(): string;

    /** @return Mutators\Mutator[]|string[] */
    abstract public static function placeholders(): array;

    public static function mutators(): Mutators\Mutators|string
    {
        return Mutators\Mutators::class;
    }
}
