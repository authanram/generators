<?php

declare(strict_types=1);

namespace Authanram\Generators\Tests\TestClasses;

class TestDescriptorWithPattern extends TestDescriptor
{
    public static function pattern(): string
    {
        return '!! %s ##';
    }
}
