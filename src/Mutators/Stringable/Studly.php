<?php

declare(strict_types=1);

namespace Authanram\Generators\Mutators\Stringable;

use Authanram\Generators\Contracts\Stringable;
use Authanram\Generators\Subject;

trait Studly
{
    public static function studly(Subject $subject): Stringable
    {
        return $subject->value->studly();
    }
}
