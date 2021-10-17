<?php

declare(strict_types=1);

namespace Authanram\Generators\Mutators\Php;

use Authanram\Generators\Mutators\Mutator;
use Authanram\Generators\Subject;
use Illuminate\Support\Stringable;

class Getter extends Mutator
{
    public static function handle(Subject $subject): Stringable
    {
        return $subject->value->studly()->prepend('get');
    }
}
