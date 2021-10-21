<?php

declare(strict_types=1);

namespace Authanram\Generators\Tests\TestClasses;

class TestDescriptorWithPath extends TestDescriptor
{
    public static function path(): string
    {
        return __DIR__.'/../stubs/test.stub';
    }
}
