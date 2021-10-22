<?php

declare(strict_types=1);

namespace Authanram\Generators\Services;

use Authanram\Generators\Contracts\Pipe;
use Authanram\Generators\Contracts\Services\Pipes as Contract;

final class Pipes extends Service implements Contract
{
    /** @return array<Pipe|string> */
    public function pipes(): array
    {
        return $this->passable()->descriptor()::pipes();
    }
}
