<?php

declare(strict_types=1);

namespace Authanram\Generators;

use InvalidArgumentException;

class Placeholder
{
    public function __construct(protected string $pattern = '{{ %s }}') {}

    public static function use(string $append, string $prepend): static
    {
        if (trim($append) === '') {
            throw new InvalidArgumentException('Argument [$append] cannot be empty.');
        }

        if (trim($prepend) === '') {
            throw new InvalidArgumentException('Argument [$prepend] cannot be empty.');
        }

        return new static("$append %s $prepend");
    }

    public function getPattern(): string
    {
        return $this->pattern;
    }
}
