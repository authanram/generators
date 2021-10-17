<?php

declare(strict_types=1);

namespace Authanram\Generators\Mutators\Php;

use Authanram\Generators\Contracts\Stringable;
use Authanram\Generators\Subject;

trait Setter
{
    public static function setter(Subject $subject): Stringable
    {
        return $subject->value->studly()->prepend('set');
    }
}
