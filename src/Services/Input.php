<?php

declare(strict_types=1);

namespace Authanram\Generators\Services;

use Authanram\Generators\Contracts\Services\Input as Contract;

final class Input implements Contract
{
    /** @param array<string> $input */
    public function validateInput(array $input): Contract
    {
        return $this;
    }

    /** @param array<string> $input */
    public function withInput(array $input): Contract
    {
        return $this;
    }
}
