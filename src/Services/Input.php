<?php

declare(strict_types=1);

namespace Authanram\Generators\Services;

use Authanram\Generators\Contracts\Services\Input as Contract;

final class Input extends Service implements Contract
{
    /** @return array<string> */
    public function input(): array
    {
        return $this->passable()->input();
    }
}
