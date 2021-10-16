<?php

declare(strict_types=1);

namespace Authanram\Generators\Mutators;

use Authanram\Generators\Mutator;
use Illuminate\Support\Stringable;

class None extends Mutator
{
    public function handle(Stringable $subject): Stringable
    {
        return $subject;
    }
}
