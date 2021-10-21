<?php

declare(strict_types=1);

namespace Authanram\Generators\Contracts;

use InvalidArgumentException;

interface Pattern
{
    /** @throws InvalidArgumentException */
    public static function make(string $phrase): static;

    public function getPhrase(): string;
}
