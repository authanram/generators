<?php

declare(strict_types=1);

namespace Authanram\Generators\Tests\TestClasses;

use Authanram\Generators\Descriptor;
use Authanram\Generators\Input;

class TestDescriptor extends Descriptor
{
    public static function path(): string
    {
        return __DIR__.'/../stubs/test.stub';
    }

    public static function fill(Input $data): array
    {
        return [
            'second' => $data->str('second')->lower(),
            'fourth' => $data->str('fourth')->upper(),
        ];
    }
}
