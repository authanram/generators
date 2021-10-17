<?php /** @noinspection PhpDocSignatureInspection */

declare(strict_types=1);

namespace Authanram\Generators;

abstract class Descriptor
{
    public const TYPE = TYPE::class;

    protected static $placeholder = '{{ %s }}';

    protected static $placeholderSeparator = '::';

    abstract public static function stub(): string;

    /** @return Mutators\Mutator[]|string[] */
    abstract public static function placeholders(): array;
}
