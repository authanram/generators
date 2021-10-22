<?php

declare(strict_types=1);

namespace Authanram\Generators\Services;

use Authanram\Generators\Contracts\Services\Input as Contract;

final class Input implements Contract
{
    /** @var array<string> */
    private array $input;

    /** @param array<string> $input */
    public function withInput(array $input): Contract
    {
        $this->input = $input;

        return $this;
    }

    /** @return array<string> */
    public function input(): array
    {
        return $this->input;
    }
}
