<?php

declare(strict_types=1);

namespace Authanram\Generators\Mutators\Php;

use Authanram\Generators\Mutators\Mutator;
use Authanram\Generators\Subject;
use Illuminate\Support\Stringable;

class NamespaceName extends Mutator
{
    public static function handle(Subject $subject): Stringable|string
    {
        return $subject->value->camel();
    }
}
