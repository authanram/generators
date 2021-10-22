<?php

declare(strict_types=1);

namespace Authanram\Generators\Contracts\Services;

interface Pipes
{
    /** @return array<callable> */
    public function pipes(): array;
}
