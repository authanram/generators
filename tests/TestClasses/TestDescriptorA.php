<?php

declare(strict_types=1);

namespace Authanram\Generators\Tests\TestClasses;

use Authanram\Generators\Descriptor;

final class TestDescriptorA extends Descriptor
{
    public static function path(): string
    {
        return __DIR__.'/../stubs/test.stub';
    }
}
