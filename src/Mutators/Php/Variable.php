<?php

declare(strict_types=1);

namespace Authanram\Generators\Mutators\Php;

use Authanram\Generators\Contracts\Stringable;
use Authanram\Generators\Subject;

trait Variable
{
    public static function variable(Subject $subject): Stringable
    {
        return $subject->value->camel();
    }
}
