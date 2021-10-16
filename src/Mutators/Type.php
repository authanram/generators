<?php

declare(strict_types=1);

namespace Authanram\Generators\Mutators;

use Authanram\Generators\Mutator;
use Authanram\Generators\TYPE as TYPES;
use Illuminate\Support\Stringable;

class Type extends Mutator
{
    public function handle(Stringable $subject): string
    {
        return TYPES::resolve($subject)->typeHint();
    }
}
