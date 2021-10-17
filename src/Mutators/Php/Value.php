<?php

declare(strict_types=1);

namespace Authanram\Generators\Mutators\Php;

use Authanram\Generators\Subject;
use Authanram\Generators\TYPE as TYPES;

trait Value
{
    public static function value(Subject $subject): string
    {
        return TYPES::resolve($subject->value)->defaultValue();
    }
}
