<?php

declare(strict_types=1);

namespace Authanram\Generators\Tests\TestClasses;

class TestDescriptorWithFilename extends TestDescriptor
{
    public static function filename(): string
    {
        return __DIR__.'/../stubs/test.stub';
    }
}
