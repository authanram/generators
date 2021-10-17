<?php

declare(strict_types=1);

namespace Authanram\Generators\Mutators\Stringable;

use Authanram\Generators\Contracts\Stringable;
use Authanram\Generators\Subject;

trait Prepend
{
    public static function prepend(Subject $subject): Stringable
    {
        return $subject->value->prepend($subject->options->get('prepend'));
    }
}
