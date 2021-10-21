<?php

declare(strict_types=1);

namespace Authanram\Generators\Tests\TestClasses;

use Authanram\Generators\Passable;

class TestPassable
{
    public static function fromFilename(string $filename): Passable
    {
        return Passable::make(TestDescriptor::fromFilename($filename));
    }
}
