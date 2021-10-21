<?php

declare(strict_types=1);

namespace Authanram\Generators\Contracts;

use InvalidArgumentException;

interface Pattern
{
    /** @throws InvalidArgumentException */
    public static function make(string $phrase): Pattern;

    public function phrase(): string;
}
