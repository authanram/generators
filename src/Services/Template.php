<?php

declare(strict_types=1);

namespace Authanram\Generators\Services;

use Authanram\Generators\Contracts\Services\Template as Contract;

final class Template implements Contract
{
    public function validate(string $subject): Contract
    {
        return $this;
    }

    public function withTemplate(string $subject): void
    {
    }

    public function withCallbacks(array|string $subject): void
    {
    }
}
