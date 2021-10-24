<?php

declare(strict_types=1);

namespace Authanram\Generators\Tests\TestClasses;

use Authanram\Generators\Descriptor;
use Authanram\Generators\Input;
use Illuminate\Support\Str;

class TestDescriptor extends Descriptor
{
    public static function path(): string
    {
        return __DIR__.'/../stubs/test.stub';
    }

    public static function fill(Input $data): array
    {
        return [
            'second' => (string)Str::of($data->get('second'))->kebab(),
            'fourth' => (string)Str::of($data->get('fourth'))->upper(),
        ];
    }
}
