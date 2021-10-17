<?php

declare(strict_types=1);

namespace Authanram\Generators\Mutators\Stringable;

use Authanram\Generators\Contracts\Stringable;
use Authanram\Generators\Subject;

trait Plain
{
    public static function plain(Subject $subject): Stringable
    {
        return $subject->value;
    }
}
