<?php

declare(strict_types=1);

namespace Authanram\Generators\Services;

use Authanram\Generators\Contracts\Services\Pipes as Contract;

final class Pipes implements Contract
{
    /** @param array<callable> $pipes */
    public function validatePipes(array $pipes): Contract
    {
        return $this;
    }

    /** @param array<callable> $pipes */
    public function withPipes(array $pipes): Contract
    {
        return $this;
    }
}
