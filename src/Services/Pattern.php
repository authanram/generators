<?php

declare(strict_types=1);

namespace Authanram\Generators\Services;

use Authanram\Generators\Contracts\Services\Pattern as Contract;

final class Pattern implements Contract
{
    public function validate(string $pattern): Contract
    {
        return $this;
    }

    public function withPattern(string $pattern): void
    {
    }
}
