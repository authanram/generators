<?php

declare(strict_types=1);

namespace Authanram\Generators\Contracts\Services;

interface Input
{
    /** @return array<string> */
    public function input(): array;
}
