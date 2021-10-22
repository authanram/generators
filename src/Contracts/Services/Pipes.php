<?php

declare(strict_types=1);

namespace Authanram\Generators\Contracts\Services;

use Authanram\Generators\Contracts\Pipe;

interface Pipes
{
    /** @param array<Pipe|string> $pipes */
    public function validate(array $pipes): Pipes;

    /** @param array<Pipe|string> $pipes */
    public function withPipes(array $pipes): void;
}
