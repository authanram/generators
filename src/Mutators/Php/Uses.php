<?php

declare(strict_types=1);

namespace Authanram\Generators\Mutators\Php;

use Authanram\Generators\Subject;

trait Uses
{
    public static function uses(Subject $subject): string
    {
        // @todo wrap via Stringable
        return sprintf('use %s;', $subject);
    }
}
