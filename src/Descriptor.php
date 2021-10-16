<?php /** @noinspection PhpDocSignatureInspection */

declare(strict_types=1);

namespace Authanram\Generators;

abstract class Descriptor
{
    abstract public function stub(): string;

    /** @return Mutator[]|string[] */
    abstract public function placeholders(): array;
}
