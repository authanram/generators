<?php

declare(strict_types=1);

namespace Authanram\Generators\Mutators\Stringable;

use Authanram\Generators\Contracts\Stringable;
use Authanram\Generators\Subject;

class Camel
{
    public static function make(string $foo, string $bar): string
    {
        return 'foox';
    }

    public static function handle(Subject $subject): Stringable
    {
        return $subject->value->camel();
    }
}
