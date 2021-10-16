<?php

declare(strict_types=1);

namespace Authanram\Generators\Mutators;

use Authanram\Generators\Mutator;
use Illuminate\Support\Stringable;

class Uses extends Mutator
{
    public function handle(Stringable $subject): string
    {
        return sprintf('use %s;', $subject);
    }
}
