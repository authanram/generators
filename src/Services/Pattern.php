<?php

declare(strict_types=1);

namespace Authanram\Generators\Services;

use Authanram\Generators\Contracts\Services\Pattern as Contract;

final class Pattern extends Service implements Contract
{
    public function pattern(): string
    {
        return $this->passable()->descriptor()::pattern();
    }
}
