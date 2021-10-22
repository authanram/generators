<?php

declare(strict_types=1);

namespace Authanram\Generators\Services;

use Authanram\Generators\Contracts\Services\Pattern as Contract;

final class Pattern implements Contract
{
    public function validatePattern(string $pattern): Contract
    {
        return $this;
    }

    public function withPattern(string $pattern): Contract
    {
        return $this;
    }
}
