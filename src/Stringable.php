<?php

declare(strict_types=1);

namespace Authanram\Generators;

use Illuminate\Support\Stringable as StringableBase;

class Stringable extends StringableBase implements Contracts\Stringable
{
    public function wrap(string $pattern = '%s'): static
    {
        $this->value = sprintf($pattern, $this->value);

        return $this;
    }
}
