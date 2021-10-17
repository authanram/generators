<?php

declare(strict_types=1);

namespace Authanram\Generators\Mutators\Php;

use Authanram\Generators\Contracts\Stringable;
use Authanram\Generators\Subject;

trait NamespaceName
{
    public static function namespaceName(Subject $subject): Stringable
    {
        return $subject->value->camel();
    }
}
