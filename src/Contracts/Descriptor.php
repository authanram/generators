<?php /** @noinspection PhpDocSignatureInspection */

declare(strict_types=1);

namespace Authanram\Generators\Contracts;

use Authanram\Generators\Mutator;

interface Descriptor
{
    public function stub(): string;

    public function type(): string;

    public function description(): string;

    public function namespace(): string;

    /** @return Mutator[]|string[] */
    public function mutators(): array;
}
