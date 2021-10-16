<?php

declare(strict_types=1);

namespace Authanram\Generators\Mutators;

use Authanram\Generators\Mutator;
use Illuminate\Support\Stringable;

class VariableDoc extends Mutator
{
    public function handle(Stringable $subject): Stringable
    {
        return $subject->kebab()->slug(' ');
    }
}
