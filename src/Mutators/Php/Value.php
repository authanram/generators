<?php

declare(strict_types=1);

namespace Authanram\Generators\Mutators\Php;

use Authanram\Generators\Mutators\Mutator;
use Authanram\Generators\Subject;
use Authanram\Generators\TYPE as TYPES;

class Value extends Mutator
{
    public static function handle(Subject $subject): string
    {
        return TYPES::resolve($subject->value)->defaultValue();
    }
}
