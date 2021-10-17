<?php

declare(strict_types=1);

namespace Authanram\Generators\Mutators\Stringable;

use Authanram\Generators\Contracts\Stringable;
use Authanram\Generators\Subject;

trait Wrap
{
    public static function wrap(Subject $subject): Stringable
    {
        $pattern = $subject->options->get('pattern');

        return $subject->value->studly()->wrap($pattern);
    }
}
