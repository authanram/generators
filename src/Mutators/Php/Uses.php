<?php

declare(strict_types=1);

namespace Authanram\Generators\Mutators\Php;

use Authanram\Generators\Mutators\Mutator;
use Authanram\Generators\Subject;

class Uses extends Mutator
{
    public static function handle(Subject $subject): string
    {
        return sprintf('use %s;', $subject->value);
    }
}
