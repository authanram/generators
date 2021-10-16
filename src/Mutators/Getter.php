<?php

declare(strict_types=1);

namespace Authanram\Generators\Mutators;

use Authanram\Generators\Mutator;
use Illuminate\Support\Stringable;

class Getter extends Mutator
{
    public function handle(Stringable $subject): Stringable
    {
        return $subject->studly()->prepend('get');
    }
}
