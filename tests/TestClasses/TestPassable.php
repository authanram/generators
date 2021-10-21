<?php

declare(strict_types=1);

namespace Authanram\Generators\Tests\TestClasses;

use Authanram\Generators\Passable;

class TestPassable extends Passable
{
    public static function fromFilename(string $filename): static
    {
        return parent::make(TestDescriptor::fromFilename($filename));
    }
}
