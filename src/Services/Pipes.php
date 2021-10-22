<?php

declare(strict_types=1);

namespace Authanram\Generators\Services;

use Authanram\Generators\Contracts\Services\Pipes as Contract;

final class Pipes implements Contract
{
    public function validate(array $pipes): Contract
    {
        return $this;
    }

    public function withPipes(array $pipes): void
    {
    }
}
