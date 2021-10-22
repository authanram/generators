<?php

declare(strict_types=1);

namespace Authanram\Generators\Contracts\Services;

interface Input
{
    /** @param array<string> $input */
    public function withInput(array $input): Input;

    /** @return array<string> */
    public function input(): array;
}
